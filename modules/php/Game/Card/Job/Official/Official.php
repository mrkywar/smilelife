<?php

namespace SmileLife\Card\Job\Official;

use SmileLife\Card\Job\Job;

/**
 * Description of Offical
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
abstract class Official extends Job {

    public function __construct() {
        parent::__construct();

        $this->setSubtitle(clienttranslate('Official'));
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Override
     * ---------------------------------------------------------------------- */

    public function getCategory(): string {
        return "official_" . parent::getCategory();
    }
}
