<?php

namespace SmileLife\Game\Card\Category\Studies;

use SmileLife\Game\Card\Card;
use SmileLife\Game\Card\Core\Exception\CardException;

/**
 * Description of Studies
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
abstract class Studies extends Card {

    private const SMILE_POINT = 1;

    public function __construct() {
        parent::__construct();

        $this->setTitle(clienttranslate('Higher'))
                ->setText2(clienttranslate('Studies'));
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - new Abstract
     * ---------------------------------------------------------------------- */

    abstract public function getLevel(): int;
    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    public function canBeAttacked(): bool {
        return true;
    }

    public function canBePlayed(): bool {
        throw new CardException("C-Studies-01 : check if the max studies are not reached");
    }

    public function getSmilePoints(): int {
        return self::SMILE_POINT;
    }

    public function getCategory(): string {
        return "studie";
    }
}
