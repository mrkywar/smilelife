<?php

namespace SmileLife\Card\Consequence\Category\Studies;

use Core\Requester\Response\Response;
use SmileLife\Card\CardManager;
use SmileLife\Card\Consequence\ConsequenceException;

/**
 * Description of LimitlessStudieConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class LimitlessStudieConsequence extends StudiesConsequence {

    public function execute(Response &$response) {
        $card = $this->getStudies();
        $card->setIsUsed(true);

        $cm = new CardManager();
        $cm->update($card);

        $response->set("card", $card);
    }

}
