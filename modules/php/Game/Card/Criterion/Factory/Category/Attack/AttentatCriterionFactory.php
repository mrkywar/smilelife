<?php

namespace SmileLife\Card\Criterion\Factory\Category\Attack;

use SmileLife\Card\Card;
use SmileLife\Card\Category\Child\Child;
use SmileLife\Card\Consequence\Category\Attack\OffsideConsequence;
use SmileLife\Card\Consequence\Category\Child\AllChildOffsideConsequence;
use SmileLife\Card\Criterion\CriterionInterface;
use SmileLife\Card\Criterion\Factory\Category\CardPlayableCriterionFactory;
use SmileLife\Card\Criterion\GenericCriterion\AllPlayerTablesCriterion;
use SmileLife\Card\Criterion\GenericCriterion\CriterionGroup;
use SmileLife\Card\Criterion\GenericCriterion\InversedCriterion;
use SmileLife\Card\Criterion\JobCriterion\JobEffectCriteria;
use SmileLife\Card\Criterion\PlayerTableCriterion\CardOnTableCriterion;
use SmileLife\Card\Effect\Category\AttentatProtectionEffect;
use SmileLife\Table\PlayerTable;

/**
 * Description of AttentatCriterionFactory
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class AttentatCriterionFactory extends CardPlayableCriterionFactory {

    /**
     * 
     * @param PlayerTable $table : Game table of the player who plays
     * @param Card $card : The card that is played
     * @param PlayerTable $opponentTable : Game table of player targeted by attack (required here)
     * @param Card[] $complementaryCards : Other cards chosen as part of purchase by example(useless here)
     * @return CriterionInterface
     */
    public function getCardCriterion(PlayerTable $table, Card $card, PlayerTable $opponentTable = null, Card $complementaryCards = null): CriterionInterface {
        $cardOnTableCiterion = new AllPlayerTablesCriterion(new CardOnTableCriterion($table, Child::class));
        $cardOnTableCiterion->setErrorMessage(clienttranslate("No child on game"));

        $noImmunityInGame = new InversedCriterion(
                new AllPlayerTablesCriterion(
                        new JobEffectCriteria($table, AttentatProtectionEffect::class)
                )
        );
        $noImmunityInGame->setErrorMessage(clienttranslate("There's a soldier watching, you can't plant a bomb safely"));

        $criteria = new CriterionGroup([
            parent::create($table, $card, $opponentTable, $complementaryCards),
            $cardOnTableCiterion,
            $noImmunityInGame
                ], CriterionGroup::AND_OPERATOR
        );

        $criteria
                ->addConsequence(new OffsideConsequence($card, $table))
                ->addConsequence(new AllChildOffsideConsequence());

        return $criteria;
    }
}
