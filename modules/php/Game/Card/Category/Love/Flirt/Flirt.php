<?php

namespace SmileLife\Card\Category\Love\Flirt;

use SmileLife\Card\Category\Love\Love;
use SmileLife\Card\Core\Exception\CardException;
use SmileLife\Table\PlayerTable;

/**
 * Description of Flirt
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
abstract class Flirt extends Love {

    private const SMILE_POINTS = 1;

    /**
     * 
     * @var string
     */
    private $pileName;

    public function __construct() {
        parent::__construct();
        $this->pileName = "love";

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

    public function canBePlayed(PlayerTable $table): bool {
        throw new CardException("C-Firt01 : Check that the player is not married or has not already asked a flirt in the same place or reached the maximum flirt");
    }

    public function getSmilePoints(): int {
        return self::SMILE_POINTS;
    }

    public function getCategory(): string {
        return "flirt";
    }

    public function getPileName(): string {
        return $this->pileName;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Getters & Setters
     * ---------------------------------------------------------------------- */

    public function setPileName(string $pileName) {
        $this->pileName = $pileName;
        return $this;
    }

}
