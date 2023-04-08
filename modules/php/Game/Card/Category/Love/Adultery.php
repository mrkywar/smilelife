<?php

namespace SmileLife\Card\Category\Love;

use SmileLife\Card\CardType;
use SmileLife\Card\Core\Exception\CardException;
use SmileLife\Card\Module\BaseGame;
use SmileLife\Table\PlayerTable;

/**
 * Description of Adultery
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class Adultery extends Love implements BaseGame {

    private const SMILE_POINTS = 1;

    public function __construct() {
        parent::__construct();

        $this->setTitle(clienttranslate('Adultery'))
                ->setText1(clienttranslate('Flirt while married while you keep '
                                . 'this card put down. Loss of children in the '
                                . 'case of divorce.'));
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    public function canBeAttacked(): bool {
        return false;
    }

    public function canBePlayed(PlayerTable $table): bool {
        throw new CardException("C-Adultery01 : Check that the player is already married");
    }

    public function canGenerateChild(): bool {
        return false;
    }

    public function getClass(): string {
        return self::class;
    }

    public function getSmilePoints(): int {
        return self::SMILE_POINTS;
    }

    public function getType(): int {
        return CardType::ADULTERY;
    }

    public function getCategory(): string {
        return "adultery";
    }
    
    public function getPileName(): string {
        return "adultery";
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame
     * ---------------------------------------------------------------------- */

    public function getBaseCardCount(): int {
        return 3;
    }

}
