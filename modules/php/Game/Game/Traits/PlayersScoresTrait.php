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
        $players = [];

        foreach ($playersTables as $table) {
            $score = mt_rand(0, 100);
            $scores[$table->getId()] = $score; //$this->computeScore($table);
            $player = $table->getPlayer();
            $player->setScore($score);
            $players[] = $player;
        }

        $this->playerManager->update($players);

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

    function doResolution() {
        // Clean 
        $sql = "DELETE FROM result";
        $this->query($sql);
        // Calc results
        $nbplayers = self::getPlayersNumber();
        for ($player_no = 1; $player_no <= $nbplayers; $player_no++) {
            $total = 0;
            $player_id = $this->getPlayerId($player_no);
            // Cards
            $sql = "SELECT card_id, card_type, card_num, card_order FROM card";
            $sql .= " WHERE card_location = 'player' AND card_player_no = $player_no";
            $cards = $this->getCollection($sql);
            // Add ref to each card
            foreach ($cards as &$card_update) {
                if ($card_update['card_type'] == 1) {
                    $card_update['ref'] = $this->regions[$card_update['card_num']];
                } else if ($card_update['card_type'] == 2) {
                    $card_update['ref'] = $this->sanctuaries[$card_update['card_num']];
                }
            }
            // Scores for each card
            $score_aux = 100;
            foreach ($cards as $card) {
                // Order (nb of card to consider)
                $order_min = 1;
                if ($card['card_type'] == 1)
                    $order_min = $card['card_order'];
                // Score
                $score = $this->calcScoreCard($cards, $card, $order_min);
                $total += $score;
                // Save result
                $round = $card['card_order'];
                if ($card['card_type'] == 2)
                    $round = -$round;
                $card_id = $card['card_id'];
                $card_type = $card['card_type'];
                $card_num = $card['card_num'];
                $sql = "INSERT INTO result (r_player_no, r_round, r_score, r_card_id, r_card_type, r_card_num) VALUES ";
                $sql .= "($player_no, $round, $score, $card_id, $card_type, $card_num)";
                $this->query($sql);
                // Stats
                if ($card['card_type'] == 1)
                    self::incStat($score, 'points_region', $player_id);
                if ($card['card_type'] == 2)
                    self::incStat($score, 'points_sanctuary', $player_id);
                // Score aux
                if ($card['card_type'] == 1) {
                    if ($card['card_num'] < $score_aux)
                        $score_aux = $card['card_num'];
                }
            }
            // Update table player
            $score_aux = -$score_aux;
            $sql = "UPDATE player SET player_score = $total, player_score_aux = $score_aux WHERE player_no = $player_no";
            $this->query($sql);
        }
        // Notify
        self::notifyAllPlayers('resolution', '', array(
            'results' => $this->getResults(),
        ));
        // End game
        $this->gamestate->nextState('endGame');
    }
}
