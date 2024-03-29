<?php

namespace SmileLife\Card\Criterion\PlayerTableCriterion;

use SmileLife\Card\CardManager;
use SmileLife\Table\PlayerTable;

/**
 * Description of CardOnTableCriterion
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class CardOnTableCriterion extends PlayerTableCriterion {

    /**
     * 
     * @var string
     */
    private $className;

    /**
     * 
     * @var CardManager
     */
    private $cardManager;

    public function __construct(PlayerTable $table, string $cardClassNeeded) {
        parent::__construct($table);

        $this->className = $cardClassNeeded;
        $this->cardManager = new CardManager();
    }

    public function isValided(): bool {
        $cards = $this->getTable()->getCards();
        foreach ($cards as $card) {
            if ($card instanceof $this->className) {
                return true;
            }
        }
        return false;
    }

}
