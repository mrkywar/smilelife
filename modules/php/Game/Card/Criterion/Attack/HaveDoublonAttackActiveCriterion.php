<?php

namespace SmileLife\Card\Criterion\Attack;

use SmileLife\Card\Category\Attack\Attack;
use SmileLife\Card\Criterion\PlayerTableCriterion\PlayerTableCriterion;
use SmileLife\Table\PlayerTable;

/**
 * Description of HaveDoublonAttackActiveCriterion
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class HaveDoublonAttackActiveCriterion extends PlayerTableCriterion {

    /**
     * 
     * @var string
     */
    private $className;

    public function __construct(PlayerTable $table, string $className) {
        $this->className = $className;

        parent::__construct($table);
    }

    public function isValided(): bool {
        foreach ($this->getTable()->getAttacks() as $card) {
            if (($card instanceof $this->className) && $this->checkAttack($card)) {
                return true;
            }
        }
        return false;
    }

    private function checkAttack(Attack $card) {
        return (!$card->getIsUsed());
    }

}
