<?php

namespace SmileLife\Game\UserEffect;

/**
 * Description of UserEffect
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
abstract class UserEffect {

    /**
     * 
     * @var string
     */
    protected $type;

    public function getType(): string {
        return $this->type;
    }

    public function setType(string $type) {
        $this->type = $type;
        return $this;
    }

}
