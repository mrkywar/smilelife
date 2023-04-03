<?php

namespace Core\Requester;

use Core\Event\EventDispatcher\EventDispatcher;
use Core\Requester\Request\Request;
use Core\Requester\Response\Response;

/**
 * Description of Requester
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
abstract class Requester extends EventDispatcher {

    public function send(Request $request) {
        $response = new Response();

        $this->dispatch($request->getType(), $request, $response);

        return $response;
    }

}
