<?php

namespace SmileLife\Card\Criterion\Factory\Category\Attack;

use SmileLife\Card\Card;
use SmileLife\Card\Category\Attack\Jail;
use SmileLife\Card\Category\Job\Job\Bandit;
use SmileLife\Card\Consequence\Category\Attack\AttackDestinationConsequence;
use SmileLife\Card\Consequence\Category\Attack\TurnPassConsequence;
use SmileLife\Card\Consequence\Category\Generic\DiscardConsequence;
use SmileLife\Card\Criterion\CriterionInterface;
use SmileLife\Card\Criterion\Factory\CardCriterionFactory;
use SmileLife\Card\Criterion\JobCriterion\JobTypeCriterion;
use SmileLife\Table\PlayerTable;

/**
 * Description of JailCriterionFactory
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class JailCriterionFactory extends CardCriterionFactory {

    /**
     * 
     * @param PlayerTable $table : Game table of the player who plays
     * @param Card $card : The card that is played
     * @param PlayerTable $opponentTable : Game table of player targeted by attack (required here)
     * @param Card[] $complementaryCards : Other cards chosen as part of purchase by example(useless here)
     * @return CriterionInterface
     */
    public function create(PlayerTable $table, Card $card, PlayerTable $opponentTable = null, array $complementaryCards = null): CriterionInterface {
        $banditCriterion = new JobTypeCriterion($opponentTable, Bandit::class);
        $banditCriterion->setErrorMessage(clienttranslate("Targeted player isn't Bandit"))
                ->addConsequence(new AttackDestinationConsequence($card, $opponentTable->getPlayer()))
                ->addConsequence(new TurnPassConsequence($opponentTable->getPlayer(), Jail::TURN_PASSED))
                ->addConsequence(new DiscardConsequence($opponentTable->getJob(), $opponentTable->getPlayer()));
        
        return $banditCriterion;
        
    }
    
}
