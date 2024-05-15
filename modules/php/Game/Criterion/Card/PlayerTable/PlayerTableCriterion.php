<?php

namespace SmileLife\Criterion\Card\PlayerTable;

use SmileLife\Card\Criterion\Criterion;
use SmileLife\Table\PlayerTable;

/**
 * Description of PlayerTableCriterion
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
abstract class PlayerTableCriterion extends Criterion {

    /**
     * 
     * @var PlayerTable
     */
    private $table;

    public function __construct(PlayerTable $table) {
        $this->table = $table;
    }

    public function getTable(): PlayerTable {
        return $this->table;
    }

    public function setTable(PlayerTable $table) {
        $this->table = $table;
        return $this;
    }

}
