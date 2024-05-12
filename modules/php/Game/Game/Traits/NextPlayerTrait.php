<?php

namespace SmileLife\Game\Traits;

use Core\Notification\Notification;
use SmileLife\Card\CardType;
use SmileLife\Card\Category\Attack\Attack;
use SmileLife\Card\Category\Attack\Jail;
use SmileLife\Card\Category\Job\Job\Bandit;
use SmileLife\Card\Category\Special\Casino;
use SmileLife\Card\Category\Wage\Wage;
use SmileLife\Card\Core\CardDecorator;
use SmileLife\Card\Core\CardLocation;
use SmileLife\Game\Calculator\Score\Score;
use SmileLife\Game\Calculator\Score\ScoreDecorator;
use SmileLife\Table\PlayerTable;
use SmileLife\Table\PlayerTableDecorator;

/**
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
trait NextPlayerTrait {

    public function stNextPlayer() {
        $playerId = intval($this->getActivePlayerId());
        $this->giveExtraTime($playerId);

        $newPlayerId = $this->activeNextPlayer();

        $playerTable = $this->tableManager->findBy(["id" => $newPlayerId]);

        $this->cardManager->getSerializer()->setIsForcedArray(true);
        $deckCard = $this->cardManager->getAllCardsInDeck();
        $this->cardManager->getSerializer()->setIsForcedArray(false);
        $cardDecorator = new CardDecorator();
        $tableDecorator = new PlayerTableDecorator();

        //--- TODO remove force end
        if (0 === count($deckCard)) {
            $scoreDecorator = new ScoreDecorator();
            $playerTables = $this->tableManager->findBy();

            $scores = [];

            foreach ($playerTables as $table) {
                $score = $this->retriveScore($table);
                $scores[$table->getId()] = $scoreDecorator->decorate($score);

                $player = $table->getPlayer();
                $player->setScore($score->getScore())
                        ->setScoreTieBreaker($score->getScoreAux());

                $this->playerManager->update($player);
            }

//            var_dump($scores);die;
            $notification = new Notification();
            $notification->setType("gameResults")
                    ->setText(clienttranslate('Finals score is computed'))
                    ->add("scores", $scores)
            //->add("scores", $scores)
            ;

            $this->sendNotification($notification);

            $this->gamestate->nextState("endGame");
        } else {
            //-- Casino Open case !
            $casino = $this->getCasinoCard();
            if (null !== $casino && $casino->getOwnerId() === $playerId) {

                if (0 === $casino->getPassTurn()) {
                    $casino->setOwnerId(null); //auto open casino
                    $notification = new Notification();
                    $notification->setType("openCasinoNotification")
                            ->setText(clienttranslate('The ${cardName} is now open'))
                            ->add('card', $cardDecorator->decorate($casino))
                            ->add('cardName', (string) $casino);

                    $this->sendNotification($notification);
                } else {
                    $casino->setPassTurn($casino->getPassTurn() - 1);
                }
                $this->cardManager->update($casino);
            }

            //-- Only One Wage Bet Case !
            $lastWage = $this->getLastBettedWage();
            if (null !== $lastWage && $lastWage->getOwnerId() === $playerId) {
                if (0 === $lastWage->getPassTurn()) {
                    $lastWage->setLocation(CardLocation::PLAYER_BOARD)
                            ->setLocationArg($playerId);

                    $playerTable->addWage($lastWage);
                    $this->tableManager->update($playerTable);

                    $notification = new Notification();
                    $notification->setType("noOtherBetNotification")
                            ->setText(clienttranslate('There was only one bet on the ${cardName}, the owner of the bet wins (but not its value)'))
                            ->add("playerId", $playerId)
                            ->add("card", $cardDecorator->decorate($lastWage))
                            ->add('cardName', (string) $casino)
                            ->add("table", $tableDecorator->decorate($playerTable));
                    $this->sendNotification($notification);
                } else {
                    $lastWage->setPassTurn($lastWage->getPassTurn() - 1);
                }

                $this->cardManager->update($lastWage);
            }

            //-- For pass turn (attack card)
            $passCard = $this->getLastActivePassTurn($playerTable);
            if (null !== $passCard) {
                $tableDecorator = new PlayerTableDecorator();
                $cardDecorator = new CardDecorator();
                $player = $playerTable->getPlayer();

                $passCard->setPassTurn($passCard->getPassTurn() - 1);
                $this->cardManager->update($passCard);

                if ($passCard->getPassTurn() < 1) {
                    $notifications = [];
                    if ($passCard instanceof Jail) {
                        $this->jailDiscarding($passCard, $playerTable->getJob(), $playerTable);
                    } else {
                        $passCard->setIsUsed(true);
                        $this->cardManager->update($passCard);
                        $this->passTurnNotification($passCard, $playerTable);
                    }
                } else {
                    $this->passTurnNotification($passCard, $playerTable);
                }

                $this->gamestate->nextState("playerPass");
            } else {
                $this->gamestate->nextState("newTurn");
            }
        }
    }

    private function getCasinoCard(): ?Casino {
        $cards = $this->cardManager->findBy(["type" => CardType::CARD_TYPE_CASINO, "location" => CardLocation::SPECIAL_CASINO]);
        if (empty($cards)) {
            return null;
        } else {
            return $cards;
        }
    }

    private function retriveScore(PlayerTable $table): Score {
        return $this->scoreCalculator->compute($table);
    }

    private function getLastBettedWage(): ?Wage {
        $casinoCards = $this->cardManager->getAllCardsInCasino();

        foreach ($casinoCards as $card) {
            if ($card instanceof Wage) {
                return $card;
            }
        }
        return null;
    }

    private function getLastActivePassTurn(PlayerTable $table): ?Attack {
        $attacks = $table->getAttacks();

        foreach ($attacks as $attack) {
            if ($attack->getPassTurn() > 0) {
                return $attack;
            }
        }

        return null;
    }

    private function jailDiscarding(Jail $passCard, Bandit $job, PlayerTable $table) {
        $tableDecorator = new PlayerTableDecorator();
        $cardDecorator = new CardDecorator();
        $player = $table->getPlayer();

        $this->cardManager->discardCard($passCard, $player);
        $this->cardManager->discardCard($job, $player);
        $table->removeCard($passCard);
        $table->removeCard($job);

        $discardedCards = $this->cardManager->getAllCardsInDiscard();

        // Notify discard Job 
        $notification = new Notification();

        $notification->setType("discardNotification")
                ->setText(clienttranslate('${player_name} discard ${cardName}'))
                ->add('player_name', $player->getName())
                ->add('playerId', $player->getId())
                ->add('card', $cardDecorator->decorate($job))
                ->add('cardName', (string) $job)
                ->add('discard', $cardDecorator->decorate($discardedCards))
//                ->add('table', $this->tableDecorator->decorate($table));;
        ;
        $this->sendNotification($notification);

        // Notify discard Prison 
        $notification2 = new Notification();

        $notification2->setType("discardNotification")
                ->setText(clienttranslate('${player_name} pass a turn but discard ${cardName} after ${turnCount} turns'))
                ->add('player_name', $player->getName())
                ->add('playerId', $player->getId())
                ->add('turnCount', $passCard->getDefaultPassTurn())
                ->add('cardName', (string) $passCard)
                ->add('card', $cardDecorator->decorate($passCard))
                ->add('discard', $cardDecorator->decorate($discardedCards))
                ->add('table', $tableDecorator->decorate($table));

        $this->sendNotification($notification2);
    }

    private function passTurnNotification(Attack $passCard, PlayerTable $table) {
        $cardDecorator = new CardDecorator();
        $tableDecorator = new PlayerTableDecorator();
        $notification = new Notification();
        $player = $table->getPlayer();

        $discardedCards = $this->cardManager->getAllCardsInDiscard();

        $notification->setType("turnpassNotification")
                ->setText(clienttranslate('${player_name} misses a turn because of the ${cardName} card '))
                ->add('player_name', $player->getName())
                ->add('playerId', $player->getId())
                ->add('cardName', (string) $passCard)
                ->add('card', $cardDecorator->decorate($passCard))
                ->add('table', $tableDecorator->decorate($table))
                ->add('discard', $cardDecorator->decorate($discardedCards));
        ;
        $this->sendNotification($notification);
    }
}
