<?php

namespace SmileLife\Card\Consequence\Category\Attack;

use Core\Requester\Response\Response;
use SmileLife\Card\Consequence\Consequence;
use SmileLife\Card\Consequence\ConsequenceException;

/**
 * Description of AttentatConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class AttentatConsequence extends Consequence {
    
    public function execute(Response &$response) {
        throw new ConsequenceException("AC-01 - Not Implemented yet");
    }

}
