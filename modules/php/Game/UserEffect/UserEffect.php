<?php

namespace SmileLife\Game\UserEffect;

use Core\Models\Core\Model;

/**
 * Description of UserEffect
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
abstract class UserEffect extends Model {

    /**
     * 
     * @var string
     */
    protected $type;
    
    public function __construct() {
        ;
    }
    
    
    

    /* -------------------------------------------------------------------------
     *                  BEGIN - Getters & Setters 
     * ---------------------------------------------------------------------- */

    public function getType(): string {
        return $this->type;
    }

    public function setType(string $type) {
        $this->type = $type;
        return $this;
    }

}
