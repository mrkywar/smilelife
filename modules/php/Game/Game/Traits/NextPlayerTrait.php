<?php

namespace SmileLife\Game\Traits;

use Core\Notification\Notification;
use SmileLife\Card\Category\Attack\Attack;
use SmileLife\Card\Category\Attack\Jail;
use SmileLife\Card\Core\CardDecorator;
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
        $passCard = $this->getLastActivePassTurn($playerTable);

        if (null !== $passCard) {
            $tableDecorator = new PlayerTableDecorator();
            $cardDecorator = new CardDecorator();
            $player = $playerTable->getPlayer();

            $passCard->setPassTurn($passCard->getPassTurn() - 1);

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
                ->add('discard', $cardDecorator->decorate($discardedCards));
        ;
        $this->sendNotification($notification);

        // Notify discard Prison 
        $notification2 = new Notification();

        $notification2->setType("discardNotification")
                ->setText(clienttranslate('${player_name} discard ${cardName} after ${turnCount} turns passed'))
                ->add('player_name', $player->getName())
                ->add('playerId', $player->getId())
                ->add('turnCount', $passCard->getDefaultPassTurn())
                ->add('cardName', (string) $passCard)
                ->add('card', $cardDecorator->decorate($passCard))
                ->add('discard', $cardDecorator->decorate($discardedCards));
        ;
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
