<?php

namespace SmileLife\Card\Criterion\Factory\Category\Attack;

use SmileLife\Card\Card;
use SmileLife\Card\Consequence\Category\Attack\AttackDestinationConsequence;
use SmileLife\Card\Consequence\Category\Attack\DiscardLastStudieConsequence;
use SmileLife\Card\Consequence\Category\Generic\GenericCardPlayedConsequence;
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
        
        $criteria->addConsequence(new AttackDestinationConsequence($card, $opponentTable))
                ->addConsequence(new DiscardLastStudieConsequence($opponentTable))
                ->addConsequence(new GenericCardPlayedConsequence($card, $opponentTable));
        
        return $criteria;
    }

}
