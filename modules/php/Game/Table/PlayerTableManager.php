<?php

namespace SmileLife\Game\Table;

use Core\Managers\Core\SuperManager;
use Core\Serializers\Serializer;

/**
 * Description of PlayerTableManager
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class PlayerTableManager extends SuperManager {

    public function initNewGame($options) {
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Define Abstracts Methods 
     * ---------------------------------------------------------------------- */

    protected function initSerializer(): Serializer {
        return new Serializer(PlayerTable::class);
    }

}