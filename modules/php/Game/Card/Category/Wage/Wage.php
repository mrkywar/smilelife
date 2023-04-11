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
            throw new CardException(clienttranslate('You didn\'t have an active Job'));
            return false;
        } else {
            if ($this->getAmount() > $job->getMaxSalary()) {
                throw new CardException(clienttranslate('Your current Job only allows you to play salary level ${max} maximum', ['max' => $job->getMaxSalary()]));
            }
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
