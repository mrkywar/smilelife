<?php

namespace SmileLife\Card\Criterion\Factory\Category\Attack;

use SmileLife\Card\Card;
use SmileLife\Card\Category\Studies\Studies;
use SmileLife\Card\Consequence\Category\Attack\AttackDestinationConsequence;
use SmileLife\Card\Consequence\Category\Attack\DiscardLastStudieConsequence;
use SmileLife\Card\Consequence\Category\Attack\StudieLevelDecreaseConsequence;
use SmileLife\Card\Consequence\Category\Generic\GenericCardPlayedConsequence;
use SmileLife\Card\Consequence\ConsequenceException;
use SmileLife\Card\Criterion\CriterionInterface;
use SmileLife\Card\Criterion\Factory\CardCriterionFactory;
use SmileLife\Card\Criterion\GenericCriterion\CriterionGroup;
use SmileLife\Card\Criterion\GenericCriterion\InversedCriterion;
use SmileLife\Card\Criterion\JobCriterion\HaveJobCriterion;
use SmileLife\Card\Criterion\StudiesCriterion\HaveStudiesCriterion;
use SmileLife\Table\PlayerTable;

/**
 * Description of GradeRepetitionCriterionFactory
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class GradeRepetitionCriterionFactory extends CardCriterionFactory {

    /**
     * 
     * @param PlayerTable $table : Game table of the player who plays
     * @param Card $card : The card that is played
     * @param PlayerTable $opponentTable : Game table of player targeted by attack (required here)
     * @param Card[] $complementaryCards : Other cards chosen as part of purchase by example(useless here)
     * @return CriterionInterface
     */
    public function create(PlayerTable $table, Card $card, PlayerTable $opponentTable = null, array $complementaryCards = null): CriterionInterface {
        $noJobCriterion = new InversedCriterion(new HaveJobCriterion($opponentTable));
        $noJobCriterion->setErrorMessage(clienttranslate("Targeted player has an active Job"));

        $haveStudieCriterion = new HaveStudiesCriterion($opponentTable);
        $haveStudieCriterion->setErrorMessage(clienttranslate("Targeted player have no studies"));

        $criteria = new CriterionGroup([
            $noJobCriterion,
            $haveStudieCriterion
                ], CriterionGroup::AND_OPERATOR);

        $lastStudies = $this->getLastUnusedStudie($table->getStudies());

        $criteria->addConsequence(new AttackDestinationConsequence($card, $opponentTable))
                ->addConsequence(new DiscardLastStudieConsequence($lastStudies, $opponentTable))
                ->addConsequence(new StudieLevelDecreaseConsequence($lastStudies, $opponentTable))
                ->addConsequence(new GenericCardPlayedConsequence($card, $opponentTable));

        return $criteria;
    }

    /**
     * 
     * @param Studies[] $studies
     * @return Studies
     */
    private function getLastUnusedStudie($studies): Studies {
        foreach ($studies as $studie) {
            if (!$studie->getIsFlipped()) {
                return $studie;
            }
        }

        throw new ConsequenceException("DLSC-01 : No aviable Studies");
    }

}
