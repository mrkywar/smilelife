<?php

namespace SmileLife\Criterion\Card\Wage;

use SmileLife\Card\Acquisition\Acquisition;
use SmileLife\Card\Wage\Wage;
use SmileLife\Criterion\Card\PlayerTable\PlayerTableCriterion;
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

    /**
     * 
     * @var float
     */
    private float $priceReduction;

    public function __construct(PlayerTable $table, Acquisition $cardToBuy, array $wages = null, float $priceReduction = null) {
        parent::__construct($table);
        $this->card = $cardToBuy;
        $this->wages = $wages;
        $this->priceReduction = (null === $priceReduction) ? 1 : $priceReduction;
    }

    public function isValided(): bool {
        $total = 0;

        foreach ($this->wages as $wage) {
            $total += $wage->getAmount();
        }
        return ($this->card->getPrice() * $this->priceReduction) <= $total;
    }
}
