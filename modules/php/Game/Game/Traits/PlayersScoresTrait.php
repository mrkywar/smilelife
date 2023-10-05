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

        $scores = [];

        foreach ($playersTables as $table) {
            $scores[$table->getId()] = $this->computeScore($table);
        }

        $notification = new Notification();
        $notification->setType("scoreNotification")
                ->setText(clienttranslate('Finals score is computed'))
                ->add("scores", $scores);

        $this->sendNotification($notification);

        $this->gamestate->nextState();
    }

    private function computeScore(PlayerTable $table) {
        $score = $this->scoreCalculator->compute($table);
        $player = $table->getPlayer();
        $player->setScore($score)
                ->setScoreTieBreaker(count($table->getAttackIds()));
        $this->playerManager->update($player);

        return $score;
    }

}
