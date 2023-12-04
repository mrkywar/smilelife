<?php

namespace SmileLife\Card\Criterion\SpecialCriterion;

use SmileLife\Card\CardManager;
use SmileLife\Card\CardType;
use SmileLife\Card\Category\Special\Casino;
use SmileLife\Card\Core\CardLocation;
use SmileLife\Card\Criterion\PlayerTableCriterion\PlayerTableCriterion;
use SmileLife\Table\PlayerTable;

/**
 * Description of CasionOpenedCriterion
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class CasinoOpenedCriterion extends PlayerTableCriterion {

    /**
     * 
     * @var CardManager
     */
    private $cardManager;

    public function __construct(PlayerTable $table) {
        $this->cardManager = new CardManager();

        parent::__construct($table);
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    public function isValided(): bool {
        $casino = $this->retriveCasino();

        return (
                CardLocation::SPECIAL_CASINO === $casino->getLocation() &&
                (
                $casino->getOwnerId() === $this->getTable()->getId() ||
                null === $casino->getOwnerId()
                )
                );
    }

    private function retriveCasino(): Casino {
        return $this->cardManager->findBy(['type' => CardType::SPECIAL_CASINO]);
    }
}
