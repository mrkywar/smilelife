<?php

namespace SmileLife\Card\Criterion\Factory\Category\Attack;

use SmileLife\Card\Card;
use SmileLife\Card\Criterion\CriterionInterface;
use SmileLife\Card\Criterion\Factory\CardCriterionFactory;
use SmileLife\Card\Criterion\GenericCriterion\InversedCriterion;
use SmileLife\Card\Criterion\JobCriterion\HaveJobCriterion;
use SmileLife\Table\PlayerTable;

/**
 * Description of AccidentCriterionFactory
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class AccidentCriterionFactory extends CardCriterionFactory {

    /**
     * 
     * @param PlayerTable $table : Game table of the player who plays
     * @param Card $card : The card that is played
     * @param PlayerTable $opponentTable : Game table of player targeted by attack (required here)
     * @param Card[] $complementaryCards : Other cards chosen as part of purchase by example(useless here)
     * @return CriterionInterface
     */
    public function create(PlayerTable $table, Card $card, PlayerTable $opponentTable = null, array $complementaryCards = null): CriterionInterface {
        //case 1 : No Job
        $noJobCriterion = new InversedCriterion(new HaveJobCriterion($opponentTable));
        
        //case 2 : No Immunity
        $jobCriterion = new HaveJobCriterion($opponentTable);
        $jobEffectCriterion = new InversedCriterion();
    }

}
