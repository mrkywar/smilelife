<?php

namespace SmileLife\Criterion\Factory\Attack;

use SmileLife\Card\Card;
use SmileLife\Criterion\Factory\Card\CardPlayableCriterionFactory;
use SmileLife\Consequence\Attack\AttackDestinationConsequence;
use SmileLife\Consequence\Attack\DiscardLastStudieConsequence;
use SmileLife\Consequence\Generic\GenericAttackPlayedConsequence;
use SmileLife\Criterion\Card\Generic\UsedCardCriterion;
use SmileLife\Criterion\Card\Job\HaveJobCriterion;
use SmileLife\Criterion\CriterionGroup;
use SmileLife\Criterion\CriterionInterface;
use SmileLife\Criterion\InversedCriterion;
use SmileLife\Criterion\Studies\HaveStudiesCriterion;
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
