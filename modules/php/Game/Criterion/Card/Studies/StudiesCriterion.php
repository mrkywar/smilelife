<?php

namespace SmileLife\Criterion\Card\Studies;

use SmileLife\Card\Studies\Studies;
use SmileLife\Criterion\Card\PlayerTable\PlayerTableCriterion;
use SmileLife\Table\PlayerTable;

/**
 * Description of StudiesCriterion
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
abstract class StudiesCriterion extends PlayerTableCriterion {

    /**
     * 
     * @var Studies
     */
    private $card;

    public function __construct(PlayerTable $table, Studies $card) {
        parent::__construct($table);

        $this->card = $card;
    }

    public function getCard(): Studies {
        return $this->card;
    }
}
