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
        $lastFlirt = $table->getLastFlirt();

        if ($table->getMarriage() !== null) {
            return true;
        } elseif (null === $lastFlirt) {
            throw new CardException("You didn't have active Marriage or any flirt");
            return false;
        } elseif ($lastFlirt->canGenerateChild()) {
            return true;
        } else {
            throw new CardException("Your last flirtation does not allow you to conceive a child");
            return false;
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

    public function __toString() {
        return clienttranslate('${cardTitle} nammed ${childName}', [
            'cardTitle' => $this->getTitle(),
            'childName' => $this->getText1()
        ]);
    }

}
