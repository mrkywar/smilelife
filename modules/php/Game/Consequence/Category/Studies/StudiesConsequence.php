<?php

namespace SmileLife\Consequence\Category\Studies;

use SmileLife\Card\Category\Studies\Studies;
use SmileLife\Consequence\PlayerTableConsequence;
use SmileLife\Table\PlayerTable;

/**
 * Description of StudiesConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
abstract class StudiesConsequence extends PlayerTableConsequence {

    /**
     * 
     * @var Studies
     */
    private $studies;

    public function __construct(Studies $card, PlayerTable $table) {
        parent::__construct($table);
        $this->studies = $card;
    }

    public function getStudies(): Studies {
        return $this->studies;
    }

}
