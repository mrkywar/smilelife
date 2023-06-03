<?php

namespace SmileLife\Card\Consequence\Category\Studies;

use Core\Requester\Response\Response;
use SmileLife\Card\Consequence\ConsequenceException;

/**
 * Description of LimitlessStudieConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class LimitlessStudieConsequence extends StudiesConsequence {
    

    public function execute(Response &$response) {
        $card = $this->getStudies();
        $card->setIsFlipped(true);
        
        $cm = new \SmileLife\Card\CardManager();
        $cm->update_v2($card);
        die('LSC-UP2');
        
        throw new ConsequenceException("Consequence-LSC : Not Yet implemented");
    }

}
