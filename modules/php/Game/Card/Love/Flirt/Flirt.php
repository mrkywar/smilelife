<?php

namespace SmileLife\Card\Love\Flirt;

use SmileLife\Card\Core\CardPile;
use SmileLife\Card\Love\Love;
use SmileLife\Criterion\Factory\Card\CardCriterionFactory;
use SmileLife\Criterion\Factory\Love\FlirtCriterionFactory;

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
        $this->pileName = CardPile::PILE_LOVE;

        $this->setTitle(clienttranslate('Flirt'));

        if ($this->canGenerateChild()) {
            $this->setText2(clienttranslate('Possibility to have a child'));
        }
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    public function getSmilePoints(): int {
        return self::SMILE_POINTS;
    }

    public function getCategory(): string {
        return "flirt";
    }

    public function getPileName(): string {
        return $this->pileName;
    }

    public function getCriterionFactory(): CardCriterionFactory {
        return new FlirtCriterionFactory();
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Getters & Setters
     * ---------------------------------------------------------------------- */

    public function setPileName(string $pileName) {
        $this->pileName = $pileName;
        return $this;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Display
     * ---------------------------------------------------------------------- */

    public function __toString() {
        return $this->getTitle();
    }
}