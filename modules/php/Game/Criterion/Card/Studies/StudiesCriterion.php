<?php

namespace SmileLife\Criterion\Studies;

use SmileLife\Card\Category\Studies\Studies;
use SmileLife\Card\Criterion\PlayerTableCriterion\PlayerTableCriterion;
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
