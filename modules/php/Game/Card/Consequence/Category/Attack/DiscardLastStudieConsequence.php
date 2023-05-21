<?php

namespace SmileLife\Card\Consequence\Category\Attack;

use SmileLife\Card\Category\Wage\Wage;
use SmileLife\Card\Consequence\Category\Generic\DiscardConsequence;
use SmileLife\Card\Consequence\ConsequenceException;
use SmileLife\Table\PlayerTable;

/**
 * Description of DiscardLastStudieConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class DiscardLastStudieConsequence extends DiscardConsequence {

    public function __construct(PlayerTable $table) {
        $card = $this->getLastUnusedStudie($table->getStudies());
        parent::__construct($card, $table->getPlayer());
    }

    /**
     * 
     * @param Studies[] $studies
     * @return Studies
     */
    private function getLastUnusedStudie($studies): Studies {
        foreach ($studies as $studie) {
            if ($studie->getIsFlipped()) {
                return $studie;
            }
        }

        throw new ConsequenceException("DLSC-01 : No aviable Studies");
    }

}
