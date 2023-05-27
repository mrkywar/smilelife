<?php

namespace SmileLife\Card\Consequence\Category\Studies;

use Core\Requester\Response\Response;
use SmileLife\Card\Consequence\ConsequenceException;

/**
 * Description of StudieLevelIncriseConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class StudieLevelIncriseConsequence extends StudiesConsequence {

    public function execute(Response &$response) {
        throw new ConsequenceException("Consequence-SLIC : Not Yet implemented");
    }

}
