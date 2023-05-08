<?php

namespace SmileLife\Card\Criterion\CriterionTest;

use SmileLife\Card\Card;
use SmileLife\Card\Criterion\Factory\CriterionFactory;
use SmileLife\Table\PlayerTable;

/**
 * Description of CriterionTest
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class CriterionTest {

    /**
     * 
     * @var PlayerTable
     */
    private $table;
    /**
     * 
     * @var Card
     */
    private $card;
    /**
     * 
     * @var ?CriterionInterface[]
     */
    private $criteria;

    public function __construct(PlayerTable $table, Card $card) {
        $this->table = $table;
        $this->card = $card;
        
        $factory = new CriterionFactory($this->table);
        $this->criteria = $factory->create($card);
    }

    public function test() {
        $testResult = new CriterionTestResult();
        $testResult->setIsValid(false);

        foreach ($criteria as $criterion) {
            if (!$criterion->isValided()) {
                $testResult->addFailedCriterion($criterion);
            } else {
                $testResult->setIsValid(true);
            }
        }

        return $testResult;
    }

}
