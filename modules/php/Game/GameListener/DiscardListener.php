<?php

namespace SmileLife\Game\GameListener;

use Core\Event\EventListener\EventListener;

/**
 * Description of DiscardListener
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class DiscardListener extends EventListener {

    private const DISCRARD_EVENT = "discardCard";

    public function __construct() {
        $this->setMethod("onDiscard");
    }

    public function onDiscard($param) {
        var_dump($param);
        die("OK");
    }

    public function eventName(): string {
        return self::DISCRARD_EVENT;
    }

    public function getPriority(): int {
        return 1;
    }

}
