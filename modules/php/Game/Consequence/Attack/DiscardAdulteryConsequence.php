<?php

namespace SmileLife\Consequence\Attack;

use Core\Requester\Response\Response;
use SmileLife\Card\Love\Adultery;
use SmileLife\Consequence\Generic\DiscardConsequence;
use SmileLife\Table\PlayerTable;

/**
 * Description of DiscardAdulteryConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class DiscardAdulteryConsequence extends DiscardConsequence {

    public function __construct(Adultery $card, PlayerTable $table) {
        parent::__construct($card, $table);
    }

    public function execute(Response &$response) {
        $this->table->removeCard($this->card);
        $this->tableManager->update($this->table);

        return parent::execute($response);
    }
}
