<?php

namespace SmileLife\Card\Category\Wage;

use SmileLife\Card\Card;
use SmileLife\Card\Core\Exception\CardException;
use SmileLife\Table\PlayerTable;

/**
 * Description of Wage
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
abstract class Wage extends Card {

    private const SMILE_POINTS = 1;

    public function __construct() {
        parent::__construct();

        $this->setTitle(clienttranslate('Wage'));
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - new Abstract
     * ---------------------------------------------------------------------- */

    abstract public function getAmount(): int;

    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    public function canBeAttacked(): bool {
        return true;
    }

    public function canBePlayed(PlayerTable $table): bool {
        $job = $table->getJob();
        if (null === $job) {
            return false;
        } else {
            return ($this->getAmount() <= $job->getMaxSalary());
        }
    }

    public function getSmilePoints(): int {
        return self::SMILE_POINTS;
    }

    public function getCategory(): string {
        return "wage";
    }

    public function getPileName(): string {
        return 'wage';
    }

}
