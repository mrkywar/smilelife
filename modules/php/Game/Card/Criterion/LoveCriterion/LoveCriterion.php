<?php

namespace SmileLife\Card\Criterion\LoveCriterion;

use SmileLife\Card\Category\Love\Love;
use SmileLife\Card\Criterion\PlayerTableCriterion\PlayerTableCriterion;
use SmileLife\Table\PlayerTable;

/**
 * Description of LoveCriterion
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
abstract class LoveCriterion extends PlayerTableCriterion {

    /**
     * 
     * @var Love
     */
    private $card;

    public function __construct(PlayerTable $table, Love $card) {
        parent::__construct($table);

        $this->card = $card;
    }

    public function getCard(): Love {
        return $this->card;
    }

}
