<?php

namespace SmileLife\Card\Criterion\WageCriterion;

use SmileLife\Card\Category\Acquisition\Acquisition;
use SmileLife\Card\Category\Wage\Wage;
use SmileLife\Card\Criterion\PlayerTableCriterion\PlayerTableCriterion;
use SmileLife\Table\PlayerTable;

/**
 * Description of HaveUnusedWageCriterion
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class HaveEnouthWageToBuyCriterion extends PlayerTableCriterion {

    /**
     * 
     * @var Acquisition
     */
    private Acquisition $card;

    /**
     * 
     * @var Wage[]
     */
    private array $wages;

    public function __construct(PlayerTable $table, Acquisition $cardToBuy, array $wages = null) {
        parent::__construct($table);
        $this->card = $cardToBuy;
        $this->wages = $wages;
    }

    public function isValided(): bool {
        $total = 0;
        
        foreach ($this->wages as $wage) {
            $total += $wage->getAmount();
        }
        return $this->card->getPrice() <= $total;
    }
}
