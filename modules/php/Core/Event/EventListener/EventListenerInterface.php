<?php

namespace Core\Event\EventListener;

/**
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
interface EventListenerInterface {

    public function eventName(): string;

    public function getPriority(): int;

    public function getMethod(): string;

    public function setMethod($method): EventListenerInterface;
}
