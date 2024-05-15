<?php

namespace SmileLife\Criterion\Card\Love;

use SmileLife\Card\Criterion\PlayerTableCriterion\PlayerTableCriterion;
use SmileLife\Game\Calculator\FlirtCountCalculator;
use SmileLife\Table\PlayerTable;

/**
 * Description of FlirtCountCriterion
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class FlirtCountCriterion extends PlayerTableCriterion {

    private const MAX_COUNT = 5;

    /**
     * 
     * @var FlirtCountCalculator
     */
    private $flirtCounter;

    public function __construct(PlayerTable $table) {
        parent::__construct($table);

        $this->flirtCounter = new FlirtCountCalculator();
    }

    public function isValided(): bool {
        $flirts = $this->getTable()->getFlirts();
        $actualCount = $this->flirtCounter->compute($flirts);
        
        return (self::MAX_COUNT > $actualCount);
    }

}
