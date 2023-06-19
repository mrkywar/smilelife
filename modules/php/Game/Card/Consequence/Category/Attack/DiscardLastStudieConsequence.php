<?php

namespace SmileLife\Card\Consequence\Category\Attack;

use Core\Requester\Response\Response;
use SmileLife\Card\Category\Studies\Studies;
use SmileLife\Card\Consequence\Category\Generic\DiscardConsequence;
use SmileLife\Table\PlayerTable;

/**
 * Description of DiscardLastStudieConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class DiscardLastStudieConsequence extends DiscardConsequence {

    public function __construct(Studies $card, PlayerTable $table) {
        parent::__construct($card, $table);
    }

    public function execute(Response &$response) {
        $this->table->removeCard($this->card);
        $this->tableManager->update($this->table);

        return parent::execute($response);
    }

}
