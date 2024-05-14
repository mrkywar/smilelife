<?php

namespace SmileLife\Consequence;

use SmileLife\Table\PlayerTable;

/**
 * Description of PlayerTableConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
abstract class PlayerTableConsequence extends Consequence{
    /**
     * 
     * @var PlayerTable
     */
    protected $table;
    
    public function __construct(PlayerTable $table) {
        $this->table = $table;
    }

}
