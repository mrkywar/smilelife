<?php

namespace SmileLife\Consequence;

use Core\Requester\Response\Response;

/**
 * Description of Consequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
abstract class Consequence {
    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    abstract public function execute(Response &$response);
}
