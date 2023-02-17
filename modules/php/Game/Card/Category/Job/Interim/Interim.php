<?php

namespace SmileLife\Game\Card\Category\Job\Interim;

use SmileLife\Game\Card\Category\Job\Job;

/**
 * Description of Interim
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
abstract class Interim extends Job {

    public function __construct() {
        parent::__construct();
        
        $this->setSubtitle(clienttranslate('Temporary employee'));
    }

}
