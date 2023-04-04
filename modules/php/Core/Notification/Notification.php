<?php

namespace Core\Notification;

use Core\Requester\Core\ParamsContainer;

/**
 * Description of Notification
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class Notification extends ParamsContainer {

    /**
     * 
     * @var string
     */
    private $type;

    /**
     * 
     * @var string
     */
    private $text;

    public function getType(): string {
        return $this->type;
    }

    public function getText(): string {
        return $this->text;
    }

    public function setType(string $type) {
        $this->type = $type;
        return $this;
    }

    public function setText(string $text) {
        $this->text = $text;
        return $this;
    }

}
