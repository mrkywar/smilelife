<?php

namespace SmileLife\Card\Consequence\Category\Attack;

use SmileLife\Card\Consequence\Consequence;
use SmileLife\Card\Consequence\ConsequenceException;

/**
 * Description of AttentatConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class AttentatConsequence extends Consequence {
    
    public function execute() {
        throw new ConsequenceException("AC-01 - Not Implemented yet");
    }

}
