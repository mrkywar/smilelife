<?php

namespace SmileLife\Card\Special;

use SmileLife\Card\CardType;
use SmileLife\Criterion\Factory\Card\CardCriterionFactory;
use SmileLife\Criterion\Factory\Special\JobBoostCriterionFactory;
use SmileLife\Module\BaseGame;

/**
 * Description of JobBoost
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class JobBoost extends Special implements BaseGame {

    public function __construct() {
        parent::__construct();

        $this->setTitle(clienttranslate('String-pulling'))
                ->setText1(clienttranslate('put down a job card without the '
                                . 'requisite level of education'));
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    public function getClass(): string {
        return self::class;
    }

    public function getType(): int {
        return CardType::CARD_TYPE_JOB_BOOST;
    }

    public function getCriterionFactory(): CardCriterionFactory {
        return new JobBoostCriterionFactory();
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame is in Special
     * ---------------------------------------------------------------------- */
}
