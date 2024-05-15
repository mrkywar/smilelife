<?php

namespace SmileLife\Consequence\Attack;

use Core\Requester\Response\Response;
use SmileLife\Card\Job\Job;
use SmileLife\Card\Job\Job\Researcher;
use SmileLife\Consequence\Generic\DiscardConsequence;
use SmileLife\Consequence\Generic\MaxCardUpdateConsequence;
use SmileLife\Table\PlayerTable;

/**
 * Description of DisardJobConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class DisardJobConsequence extends DiscardConsequence {

    public function __construct(Job $card, PlayerTable $table) {
        parent::__construct($card, $table);
    }

    public function execute(Response &$response) {
        $this->table->removeCard($this->card);
        $this->tableManager->update($this->table);

        if ($this->card instanceof Researcher) {
            $complementaryConsequence = new MaxCardUpdateConsequence($this->table, -1);
            $complementaryConsequence->execute($response);

            $response->set('playerJump', $this->table->getId())
                    ->set("nextState", "attackAndDiscard");
        }

        return parent::execute($response);
    }
}
