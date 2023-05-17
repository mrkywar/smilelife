<?php

namespace SmileLife\Card\Category\Studies;

use SmileLife\Card\Card;
use SmileLife\Card\Core\Exception\CardException;
use SmileLife\Card\Effect\CardEffectInterface;
use SmileLife\Card\Effect\Category\LimitlessStudiesEffect;
use SmileLife\Game\Calculator\StudiesLevelCalculator;
use SmileLife\Table\PlayerTable;

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

    public function canBePlayed(PlayerTable $table): bool {
        return true;
    }

    public function getSmilePoints(): int {
        return self::SMILE_POINT;
    }

    public function getCategory(): string {
        return "studies";
    }

    public function getPileName(): string {
        return 'job';
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Display
     * ---------------------------------------------------------------------- */

    public function __toString() {
        return $this->getTitle() . " " . $this->getText2();
    }

    public function __toArray(): array {
        return array_merge(
                parent::__toArray(),
                [
                    'studiesLevel' => $this->getLevel()
                ]
        );
    }

}
