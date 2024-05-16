<?php

namespace SmileLife\Criterion\Card\Love;

use SmileLife\Card\Category\Love\Flirt\Flirt;
use SmileLife\Criterion\Card\PlayerTable\PlayerTableCriterion;

/**
 * Description of LastFlirtGenerateChildCiterion
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class LastFlirtGenerateChildCiterion extends PlayerTableCriterion {

    private function getLastFlirt(): ?Flirt {

        return $this->getTable()->getLastFlirt();
    }

    public function isValided(): bool {
        $flirt = $this->getLastFlirt();
        
        return (
                $flirt instanceof Flirt &&
                $flirt->canGenerateChild() && 
                ! $flirt->getIsUsed()
        );
    }

}
