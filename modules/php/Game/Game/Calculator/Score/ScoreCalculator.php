<?php

namespace SmileLife\Game\Calculator\Score;

use SmileLife\Card\Card;
use SmileLife\Card\CardManager;
use SmileLife\Card\CardType;
use SmileLife\Card\Core\CardLocation;
use SmileLife\Table\PlayerTable;

/**
 * Description of ScoreCalculator
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class ScoreCalculator {
    
    /**
     * 
     * @var CardManager
     */
    private $cardManager;


    public function __construct() {
        $this->cardManager = new CardManager();
    }

    /**
     * 
     * @param PlayerTable $table
     * @return Score
     */
    public function compute(PlayerTable $table): Score {
        $cards = $table->getCards();
        if ($cards instanceof Card) {
            return $this->computeOne($cards);
        }
        $cardsScore = 0;

        foreach ($cards as $card) {
            $cardsScore += $this->computeOne($card, $table);
        }

        $aux = count($table->getAttackIds());
        $score = new Score();
        $score->setScore($cardsScore);
//                ->setScoreAux((null === $aux) ? 0 : $aux);

        return $score;
    }

    private function computeOne(Card $card, PlayerTable $table) {
        if (CardType::CARD_TYPE_PET_UNICORN === $card->getType()) { //-- instanceof works to
            $cardsBonus = $this->cardManager->findBy([
                'location' => CardLocation::PLAYER_BOARD,
                'locationArg' => $table->getId(),
                'type' => [CardType::CARD_TYPE_RAINBOW, CardType::CARD_TYPE_SHOOTING_STAR]
            ]);
            
            return (2 === sizeof($cardsBonus))?(2*$card->getSmilePoints()):$card->getSmilePoints();
        }
        return $card->getSmilePoints();
    }
}
