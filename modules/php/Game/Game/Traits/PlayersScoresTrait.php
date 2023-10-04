<?php

namespace SmileLife\Game\Traits;

use Core\Notification\Notification;
use SmileLife\Game\Calculator\ScoreCalculator;
use SmileLife\Table\PlayerTable;

/**
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
trait PlayersScoresTrait {

    /**
     * 
     * @var ScoreCalculator
     */
    private $scoreCalculator;

    public function stGamePlayersScores() {
        $playersTables = $this->tableManager->findBy();
        $this->scoreCalculator = new ScoreCalculator();

        foreach ($playersTables as $table) {
            $this->computeScore($table);
        }

        $this->gamestate->nextState();
    }

    private function computeScore(PlayerTable $table) {
        $score = $this->scoreCalculator->compute($table);
        $player = $table->getPlayer();
        $player->setScore($score)
                ->setScoreTieBreaker(count($table->getAttackIds()));
        $this->playerManager->update($player);

        $notification = new Notification();
        $notification->setType("scoreNotification")
                ->setText(clienttranslate('${player_name} have ${score} simles'))
                ->add('player_name', $player->getName())
                ->add('playerId', $player->getId())
                ->add('score', $score);
        ;
        $this->sendNotification($notification);
    }

//
//    private function jailDiscarding(Jail $passCard, Bandit $job, PlayerTable $table) {
//        $tableDecorator = new PlayerTableDecorator();
//        $cardDecorator = new CardDecorator();
//        $player = $table->getPlayer();
//
//        $this->cardManager->discardCard($passCard, $player);
//        $this->cardManager->discardCard($job, $player);
//        $table->removeCard($passCard);
//        $table->removeCard($job);
//
//        $discardedCards = $this->cardManager->getAllCardsInDiscard();
//
//        // Notify discard Job 
//        $notification = new Notification();
//
//        $notification->setType("discardNotification")
//                ->setText(clienttranslate('${player_name} discard ${cardName}'))
//                ->add('player_name', $player->getName())
//                ->add('playerId', $player->getId())
//                ->add('card', $cardDecorator->decorate($job))
//                ->add('cardName', (string) $job)
//                ->add('discard', $cardDecorator->decorate($discardedCards));
//        ;
//        $this->sendNotification($notification);
//
//        // Notify discard Prison 
//        $notification2 = new Notification();
//
//        $notification2->setType("discardNotification")
//                ->setText(clienttranslate('${player_name} pass a turn but discard ${cardName} after ${turnCount} turns'))
//                ->add('player_name', $player->getName())
//                ->add('playerId', $player->getId())
//                ->add('turnCount', $passCard->getDefaultPassTurn())
//                ->add('cardName', (string) $passCard)
//                ->add('card', $cardDecorator->decorate($passCard))
//                ->add('discard', $cardDecorator->decorate($discardedCards));
//        ;
//        $this->sendNotification($notification2);
//    }
//
//    private function passTurnNotification(Attack $passCard, PlayerTable $table) {
//        $cardDecorator = new CardDecorator();
//        $tableDecorator = new PlayerTableDecorator();
//        $notification = new Notification();
//        $player = $table->getPlayer();
//
//        $discardedCards = $this->cardManager->getAllCardsInDiscard();
//
//        $notification->setType("turnpassNotification")
//                ->setText(clienttranslate('${player_name} misses a turn because of the ${cardName} card '))
//                ->add('player_name', $player->getName())
//                ->add('playerId', $player->getId())
//                ->add('cardName', (string) $passCard)
//                ->add('card', $cardDecorator->decorate($passCard))
//                ->add('table', $tableDecorator->decorate($table))
//                ->add('discard', $cardDecorator->decorate($discardedCards));
//        ;
//        $this->sendNotification($notification);
//    }
}
