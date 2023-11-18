<?php

namespace SmileLife\Card\Consequence\Category\Attack;

use Core\Requester\Response\Response;
use SmileLife\Card\Category\Job\Job;
use SmileLife\Card\Category\Job\Job\Researcher;
use SmileLife\Card\Consequence\Category\Generic\DiscardConsequence;
use SmileLife\Card\Consequence\Category\Generic\MaxCardUpdateConsequence;
use SmileLife\Game\GameState\GameStateParamManager;
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
