<?php

namespace SmileLife\Card\Consequence\Category\Attack;

use Core\Requester\Response\Response;
use SmileLife\Card\Category\Studies\Studies;
use SmileLife\Card\Consequence\Category\Generic\DiscardConsequence;
use SmileLife\Card\Consequence\ConsequenceException;
use SmileLife\Table\PlayerTable;

/**
 * Description of DiscardLastStudieConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class DiscardLastStudieConsequence extends DiscardConsequence {

    public function __construct(PlayerTable $table) {
        $card = $this->getLastUnusedStudie($table->getStudies());
        parent::__construct($card, $table);
    }

    /**
     * 
     * @param Studies[] $studies
     * @return Studies
     */
    private function getLastUnusedStudie($studies): Studies {
        foreach ($studies as $studie) {
            if (!$studie->getIsFlipped()) {
                return $studie;
            }
        }

        throw new ConsequenceException("DLSC-01 : No aviable Studies");
    }

    public function execute(Response &$response) {
        $this->table->removeCard($this->card);
        $this->tableManager->update($this->table);

        return parent::execute($response);
    }

}
