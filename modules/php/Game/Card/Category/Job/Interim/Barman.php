<?php

namespace SmileLife\Game\Card\Category\Job\Interim;

use SmileLife\Game\Card\Core\CardType;
use SmileLife\Game\Card\Module\BaseGame;

/**
 * Description of Barman
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class Barman extends Interim implements BaseGame {

    public function __construct() {
        parent::__construct();

        $this->setTitle(clienttranslate('Barman'))
                ->setText1(clienttranslate('Unlimited flirts before marriage'));
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    public function getClass(): string {
        return self::class;
    }

    public function getMaxSalary(): int {
        return 1;
    }

    public function getRequiredStudies(): int {
        return 0;
    }

    public function getType(): int {
        return CardType::JOB_BARMAN;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame is in Job
     * ---------------------------------------------------------------------- */
}
