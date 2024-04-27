<?php

namespace SmileLife\Card\Criterion\Factory\Category\Special;

use SmileLife\Card\Card;
use SmileLife\Card\Consequence\Category\Wage\WageGiftConsequence;
use SmileLife\Card\Criterion\CriterionInterface;
use SmileLife\Card\Criterion\Factory\Category\CardOfferableCriterionFactory;
use SmileLife\Card\Criterion\GenericCriterion\CriterionGroup;
use SmileLife\Card\Criterion\GenericCriterion\InversedCriterion;
use SmileLife\Card\Criterion\WageCriterion\IsUsedWageCriterion;
use SmileLife\Table\PlayerTable;

/**
 * Description of OfferWageCriterionFactory
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class OfferWageCriterionFactory extends CardOfferableCriterionFactory {

    /**
     * 
     * @param PlayerTable $table : Game table of the player who plays
     * @param Card $card : The card that is played
     * @param PlayerTable $opponentTable : Game table of player targeted by attack (the gift here)
     * @param Card[] $complementaryCards : Other cards chosen as part of purchase by example(useless here)
     * @return CriterionInterface
     */
     public function getCardCriterion(PlayerTable $table, Card $card, PlayerTable $opponentTable = null, array $complementaryCards = null): CriterionInterface {
        $criterion = new InversedCriterion(new IsUsedWageCriterion($card));
        $criterion->setErrorMessage(clienttranslate("You must choose a unsued salary"))
                ->addConsequence(new WageGiftConsequence($table, $card, $opponentTable));
 
        return $criterion;
    }
}
