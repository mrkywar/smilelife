<?php

namespace SmileLife\Criterion\Factory\Attack;

use SmileLife\Card\Card;
use SmileLife\Card\Category\Job\Job\Bandit;
use SmileLife\Consequence\Category\Attack\AttackDestinationConsequence;
use SmileLife\Consequence\Category\Generic\GenericAttackPlayedConsequence;
use SmileLife\Card\Criterion\CriterionInterface;
use SmileLife\Card\Criterion\Factory\Category\CardPlayableCriterionFactory;
use SmileLife\Card\Criterion\GenericCriterion\CriterionGroup;
use SmileLife\Card\Criterion\JobCriterion\JobTypeCriterion;
use SmileLife\Table\PlayerTable;

/**
 * Description of JailCriterionFactory
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class JailCriterionFactory extends CardPlayableCriterionFactory {

    /**
     * 
     * @param PlayerTable $table : Game table of the player who plays
     * @param Card $card : The card that is played
     * @param PlayerTable $opponentTable : Game table of player targeted by attack (required here)
     * @param Card[] $complementaryCards : Other cards chosen as part of purchase by example(useless here)
     * @return CriterionInterface
     */
    public function getCardCriterion(PlayerTable $table, Card $card, PlayerTable $opponentTable = null, array $complementaryCards = null): CriterionInterface {

        $banditCriterion = new JobTypeCriterion($opponentTable, Bandit::class);
        $banditCriterion->setErrorMessage(clienttranslate("Targeted player isn't Bandit"));
//                ->addConsequence(new AttackDestinationConsequence($card, $opponentTable->getPlayer()))
//                ->addConsequence(new TurnPassConsequence($opponentTable->getPlayer(), Jail::TURN_PASSED))
//                ->addConsequence(new DiscardConsequence($opponentTable->getJob(), $opponentTable->getPlayer()))
//                ;
        $banditCriterion->addConsequence(new AttackDestinationConsequence($card, $opponentTable))
                ->addConsequence(new GenericAttackPlayedConsequence($card, $table, $opponentTable));

        return new CriterionGroup([
            $banditCriterion
                ], CriterionGroup::AND_OPERATOR);
    }
}
