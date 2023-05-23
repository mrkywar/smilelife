<?php

namespace SmileLife\Card\Consequence\Category\Attack;

use SmileLife\Card\Category\Wage\Wage;
use SmileLife\Card\Consequence\Category\Generic\DiscardConsequence;
use SmileLife\Card\Consequence\ConsequenceException;
use SmileLife\Table\PlayerTable;

/**
 * Description of DiscardLastWageConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class DiscardLastWageConsequence extends DiscardConsequence {
    
    public function __construct(PlayerTable $table) {
        $card = $this->getLastUnusedWage($table->getWages());
        parent::__construct($card, $table->getPlayer());
    }
    
    /**
     * 
     * @param Wage[] $wages
     * @return Wage
     */
    private function getLastUnusedWage($wages):Wage{
        foreach ($wages as $wage){
            if($wage->getIsFlipped()){
                return $wage;
            }
        }
        
        throw new ConsequenceException("DLWC-01 : No aviable Wage");
    }
}
