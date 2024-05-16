<?php

namespace SmileLife\Criterion\Generic;

use SmileLife\Card\Card;
use SmileLife\Card\Core\CardLocation;
use SmileLife\Criterion\Card\PlayerTable\PlayerTableCriterion;
use SmileLife\Table\PlayerTable;

/**
 * Description of CardOnPlayerTableCriterion
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class CardOnPlayerTableCriterion extends PlayerTableCriterion {

    /**
     * 
     * @var Card
     */
    private $card;

    public function __construct(PlayerTable $table, Card $card) {
        parent::__construct($table);

        $this->card = $card;
    }

    public function isValided(): bool {
        return (
                CardLocation::PLAYER_BOARD === $this->card->getLocation() &&
                $this->getTable()->getId() === $this->card->getLocationArg()
                );
    }
}
