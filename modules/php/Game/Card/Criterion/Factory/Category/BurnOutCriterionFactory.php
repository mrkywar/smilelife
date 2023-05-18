<?php

namespace SmileLife\Card\Criterion\Factory\Category;

use SmileLife\Card\Card;
use SmileLife\Card\Criterion\Factory\CardCriterionFactory;
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
     * @param ?PlayerTable $opponentTable : Game table of player targeted by attack (required here)
     * @return CriterionInterface
     */
    public function create(PlayerTable $table, Card $card, PlayerTable $opponentTable): CriterionInterface {
        $criterias = new HaveJobCriterion($opponentTable);
        $criterias->setErrorMessage(clienttranslate("Targeted player has no Job"));

        $criterias->addConsequence(new AttackDestinationConsequence($card, $opponentTable->getPlayer()))
                ->addConsequence(new TurnPassConsequence($opponentTable->getPlayer()));

        return $criteria;
    }

}
