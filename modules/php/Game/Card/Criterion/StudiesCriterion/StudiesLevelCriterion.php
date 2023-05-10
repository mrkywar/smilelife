<?php

namespace SmileLife\Card\Criterion\StudiesCriterion;

use SmileLife\Card\Category\Studies\Studies;
use SmileLife\Card\Criterion\StudiesCriterion\StudiesCriterion;
use SmileLife\Game\Calculator\StudiesLevelCalculator;
use SmileLife\Table\PlayerTable;

/**
 * Description of StudiesLevelCriterion
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class StudiesLevelCriterion extends StudiesCriterion {

    private const MAX_STUDIES_LEVEL = 6;

    /**
     * 
     * @var StudiesLevelCalculator
     */
    private $studiesLevelCalculator;

    public function __construct(PlayerTable $table, Studies $card) {
        parent::__construct($table, $card);

        $this->studiesLevelCalculator = new StudiesLevelCalculator();
    }

    public function isValided(): bool {
        $actualLevel = $this->studiesLevelCalculator->compute($this->getTable()->getStudies());
        return (self::MAX_STUDIES_LEVEL <= ($actualLevel + $this->getCard()->getLevel()));
    }

}
