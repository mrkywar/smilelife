<?php

namespace SmileLife\Card\Criterion\GenericCriterion;

use SmileLife\Card\Card;
use SmileLife\Table\PlayerTable;

/**
 * Description of CardPlayableCriterion
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class CardPlayableCriterion extends CardCriterion {

    /**
     * @var PlayerTable
     */
    private $table;

    public function __construct(Card $card = null, PlayerTable $table) {
        parent::__construct($card);

        $this->table = $table;
    }

    public function isValided(): bool {
        $factory = $this->getCard()->getCriterionFactory();
        $criterion = $factory->create($this->table, $this->getCard());

        return $criterion->isValided();
    }

}
