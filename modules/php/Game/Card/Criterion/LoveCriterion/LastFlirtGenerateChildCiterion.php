<?php

namespace SmileLife\Card\Criterion\LoveCriterion;

use SmileLife\Card\Category\Love\Flirt\Flirt;
use SmileLife\Card\Criterion\PlayerTableCriterion\PlayerTableCriterion;

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
