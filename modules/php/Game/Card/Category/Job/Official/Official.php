<?php

namespace SmileLife\Game\Card\Category\Job\Official;

use SmileLife\Game\Card\Category\Job\Job;

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

    final public function canBeAttacked(): bool {
        return false;
    }

}
