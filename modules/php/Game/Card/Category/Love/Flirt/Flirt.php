<?php

namespace SmileLife\Game\Card\Category\Love\Flirt;

use SmileLife\Game\Card\Category\Love\Love;
use SmileLife\Game\Card\Core\Exception\CardException;

/**
 * Description of Flirt
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
abstract class Flirt extends Love {

    private const SMILE_POINTS = 1;

    public function __construct() {
        parent::__construct();

        $this->setTitle(clienttranslate('Flirt'));
        
        if ($this->canGenerateChild()) {
            $this->setText2(clienttranslate('Possibility to have a child'));
        }
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    public function canBeAttacked(): bool {
        return false;
    }

    public function canBePlayed(): bool {
        throw new CardException("C-Firt01 : Check that the player is not married or has not already asked a flirt in the same place or reached the maximum flirt");
    }

    public function getSmilePoints(): int {
        return self::SMILE_POINTS;
    }

}
