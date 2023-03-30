<?php

namespace SmileLife\Card\Category\Job\Interim;

use SmileLife\Card\Category\Job\Job;

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

    /* -------------------------------------------------------------------------
     *                  BEGIN - Override
     * ---------------------------------------------------------------------- */

    public function getCategory(): string {
        return "temporary_" . parent::getCategory();
    }

}
