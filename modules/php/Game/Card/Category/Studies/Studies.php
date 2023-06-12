<?php

namespace SmileLife\Card\Category\Studies;

use SmileLife\Card\Card;
use SmileLife\Card\Criterion\Factory\CardCriterionFactory;
use SmileLife\Card\Criterion\Factory\Category\Studies\StudiesCriterionFactory;
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

    public function getSmilePoints(): int {
        return self::SMILE_POINT;
    }

    public function getCategory(): string {
        return "studies";
    }

    public function getPileName(): string {
        return 'job';
    }

    public function getCriterionFactory(): CardCriterionFactory {
        return new StudiesCriterionFactory();
    }

    public function __toString() {
        return $this->getTitle() . " " . $this->getText2();
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Display
     * ---------------------------------------------------------------------- */

    public function __toArray(): array {
        return array_merge(
                parent::__toArray(),
                [
                    'studiesLevel' => $this->getLevel()
                ]
        );
    }

}
