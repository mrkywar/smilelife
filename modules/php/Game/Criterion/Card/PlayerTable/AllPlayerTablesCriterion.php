<?php

namespace SmileLife\Criterion\Card\PlayerTable;

use SmileLife\Card\Criterion\Criterion;
use SmileLife\Card\Criterion\PlayerTableCriterion\PlayerTableCriterion;
use SmileLife\Table\PlayerTableManager;

/**
 * Description of AllPlayerTablesCriterion
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class AllPlayerTablesCriterion extends Criterion {

    /**
     * 
     * @var PlayerTableCriterion
     */
    private $criterion;
    /**
     * 
     * @var PlayerTableManager
     */
    private $tableManager;

    public function __construct(PlayerTableCriterion $criterion) {
        $this->criterion = $criterion;

        $this->tableManager = new PlayerTableManager();
    }

    public function isValided(): bool {
        foreach ($this->tableManager->findBy() as $table) {
            $this->criterion->setTable($table);
            if ($this->criterion->isValided()) {
                return true;
            }
        }
        return false;
    }

}
