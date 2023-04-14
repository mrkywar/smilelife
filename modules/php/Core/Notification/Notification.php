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

    /**
     * 
     * @var bool
     */
    private $public;

    public function __construct() {
        parent::__construct();

        $this->public = true;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Shortcut
     * ---------------------------------------------------------------------- */

    public function isPublic(): bool {
        return $this->getPublic();
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Getters & Setters 
     * ---------------------------------------------------------------------- */

    public function getPublic(): bool {
        return $this->public;
    }

    public function setPublic(bool $public) {
        $this->public = $public;
        return $this;
    }

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
