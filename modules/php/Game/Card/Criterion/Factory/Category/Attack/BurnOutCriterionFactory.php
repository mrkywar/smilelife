<?php

namespace SmileLife\Card\Criterion\Factory\Category\Attack;

use SmileLife\Card\Card;
use SmileLife\Card\Consequence\Category\Attack\AttackDestinationConsequence;
use SmileLife\Card\Consequence\Category\Attack\PassTurnConsequence;
use SmileLife\Card\Consequence\Category\Attack\TurnPassConsequence;
use SmileLife\Card\Criterion\CriterionInterface;
use SmileLife\Card\Criterion\Factory\CardCriterionFactory;
use SmileLife\Card\Criterion\JobCriterion\HaveJobCriterion;
use SmileLife\Table\PlayerTable;

/**
 * Description of BurnOutCriterionFactory
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class BurnOutCriterionFactory extends CardCriterionFactory {

    /**
     * 
     * @param PlayerTable $table : Game table of the player who plays
     * @param Card $card : The card that is played
     * @param PlayerTable $opponentTable : Game table of player targeted by attack (required here)
     * @param Card[] $complementaryCards : Other cards chosen as part of purchase by example(useless here)
     * @return CriterionInterface
     */
    public function create(PlayerTable $table, Card $card, PlayerTable $opponentTable = null, array $complementaryCards = null): CriterionInterface {
        $criterias = new HaveJobCriterion($opponentTable);
        $criterias->setErrorMessage(clienttranslate("Targeted player has no Job"));

        $criterias->addConsequence(new AttackDestinationConsequence($card, $opponentTable->getPlayer()))
                ->addConsequence(new PassTurnConsequence($card))
                ->addConsequence(new TurnPassConsequence($opponentTable->getPlayer()));

        return $criteria;
    }

}
