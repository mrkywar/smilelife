<?php

namespace SmileLife\Card\Criterion\Factory\Category\Attack;

use SmileLife\Card\Card;
use SmileLife\Card\Consequence\Category\Attack\AttackDestinationConsequence;
use SmileLife\Card\Consequence\Category\Attack\DiscardLastStudieConsequence;
use SmileLife\Card\Consequence\Category\Generic\GenericAttackPlayedConsequence;
use SmileLife\Card\Criterion\CriterionInterface;
use SmileLife\Card\Criterion\Factory\Category\CardPlayableCriterionFactory;
use SmileLife\Card\Criterion\GenericCriterion\CriterionGroup;
use SmileLife\Card\Criterion\GenericCriterion\InversedCriterion;
use SmileLife\Card\Criterion\GenericCriterion\UsedCardCriterion;
use SmileLife\Card\Criterion\JobCriterion\HaveJobCriterion;
use SmileLife\Card\Criterion\StudiesCriterion\HaveStudiesCriterion;
use SmileLife\Table\PlayerTable;

/**
 * Description of GradeRepetitionCriterionFactory
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class GradeRepetitionCriterionFactory extends CardPlayableCriterionFactory {

    /**
     * 
     * @param PlayerTable $table : Game table of the player who plays
     * @param Card $card : The card that is played
     * @param PlayerTable $opponentTable : Game table of player targeted by attack (required here)
     * @param Card[] $complementaryCards : Other cards chosen as part of purchase by example(useless here)
     * @return CriterionInterface
     */
    public function getCardCriterion(PlayerTable $table, Card $card, PlayerTable $opponentTable = null, array $complementaryCards = null): CriterionInterface {


        $noJobCriterion = new InversedCriterion(new HaveJobCriterion($opponentTable));
        $noJobCriterion->setErrorMessage(clienttranslate("Targeted player has an active Job"));

        $haveStudieCriterion = new HaveStudiesCriterion($opponentTable);
        $haveStudieCriterion->setErrorMessage(clienttranslate("Targeted player have no studies"));

        $lastStudies = $opponentTable->getLastStudies();
        $lastStudieCriterion = new InversedCriterion(new UsedCardCriterion($lastStudies));
        $lastStudieCriterion->setErrorMessage(clienttranslate("Last player's studies is protected"));

        $criteria = new CriterionGroup([
            $noJobCriterion,
            $haveStudieCriterion,
            $lastStudieCriterion
                ], CriterionGroup::AND_OPERATOR);

        if (null !== $lastStudies) {
            $criteria->addConsequence(new AttackDestinationConsequence($card, $opponentTable))
                    ->addConsequence(new DiscardLastStudieConsequence($lastStudies, $opponentTable))
                    ->addConsequence(new GenericAttackPlayedConsequence($card, $table, $opponentTable));
        }

        return $criteria;
    }
}
