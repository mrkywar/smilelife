<?php

namespace SmileLife\Card\Consequence\Category\Attack;

use Core\Requester\Response\Response;
use SmileLife\Card\Category\Child\Child;
use SmileLife\Card\Consequence\Category\Generic\DiscardConsequence;
use SmileLife\Table\PlayerTable;

/**
 * Description of DiscardChildConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class DiscardChildConsequence extends DiscardConsequence {

    public function __construct(Child $card, PlayerTable $table) {
        parent::__construct($card, $table);
    }

    public function execute(Response &$response) {
        $this->table->removeCard($this->card);
        $this->tableManager->update($this->table);

        return parent::execute($response);
    }
   

}
