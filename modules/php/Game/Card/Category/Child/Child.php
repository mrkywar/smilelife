<?php

namespace SmileLife\Card\Category\Child;

use SmileLife\Card\Card;
use SmileLife\Card\Category\Love\Flirt\Flirt;
use SmileLife\Card\Core\Exception\CardException;
use SmileLife\Table\PlayerTable;

/**
 * Description of Child
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
abstract class Child extends Card {

    public function __construct() {
        parent::__construct();

        $this->setTitle(clienttranslate('Child'));
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    public function canBeAttacked(): bool {
        return true;
    }

    public function canBePlayed(PlayerTable $table): bool {
        if ($table->getMarriage() !== null) {
            return true;
        } elseif (null === $table->getFlirts() || empty($table->getFlirts())) {
            throw new CardException("You didn't have active Marriage or any flirt");
            return false;
        }
        $tableFlirts = $table->getFlirts();
        /**
         * @var Flirt
         */
        $lastFlirt = (Flirt)($tableFlirts[sizeof($value) - 1]);
        if (!$lastFlirt->canGenerateChild()) {
            throw new CardException("Your last flirtation does not allow you to conceive a child");
            return false;
        }else{
            return true;
        }
    }

    public function getSmilePoints(): int {
        return 2;
    }

    public function getCategory(): string {
        return "child";
    }

    public function getPileName(): string {
        return "child";
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame (1 card in each type)
     * ---------------------------------------------------------------------- */

    public function getBaseCardCount(): int {
        return 1;
    }

}
