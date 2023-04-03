<?php

namespace SmileLife\Game;

use Core\Requester\Requester;

/**
 * Description of SmileLifeRequester
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class SmileLifeRequester extends Requester {

    public function __construct() {
        $loader = new GameListener\ListenerLoader();

        $files = $loader->getFilesList();
        var_dump($files);die;
    }

}
