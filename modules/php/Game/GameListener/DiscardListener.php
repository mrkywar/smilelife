<?php

namespace SmileLife\Game\GameListener;

use Core\Event\EventListener\EventListener;
use SmileLife\PlayerAction\ActionType;

/**
 * Description of DiscardListener
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class DiscardListener extends EventListener {

    public function __construct() {
        $this->setMethod("onDiscard");
    }

    public function onDiscard($param) {
        echo '<pre>??';
        var_dump($param);
        die("OK");
    }

    public function eventName(): string {
        return ActionType::ACTION_DISCRARD;
    }

    public function getPriority(): int {
        return 1;
    }

}
