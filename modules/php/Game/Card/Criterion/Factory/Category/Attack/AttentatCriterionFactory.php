<?php

namespace SmileLife\Card\Criterion\Factory\Category\Attack;

use SmileLife\Card\Card;
use SmileLife\Card\Consequence\Category\Attack\AttackDestinationConsequence;
use SmileLife\Card\Consequence\Category\Attack\AttentatConsequence;
use SmileLife\Card\Criterion\CriterionInterface;
use SmileLife\Card\Criterion\Factory\CardCriterionFactory;
use SmileLife\Card\Criterion\GenericCriterion\AllPlayerTablesCriterion;
use SmileLife\Card\Criterion\JobCriterion\JobEffectCriteria;
use SmileLife\Card\Effect\Category\AttentatProtectionEffect;
use SmileLife\Table\PlayerTable;

/**
 * Description of AttentatCriterionFactory
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class AttentatCriterionFactory extends CardCriterionFactory {

    /**
     * 
     * @param PlayerTable $table : Game table of the player who plays
     * @param Card $card : The card that is played
     * @param PlayerTable $opponentTable : Game table of player targeted by attack (required here)
     * @param Card[] $complementaryCards : Other cards chosen as part of purchase by example(useless here)
     * @return CriterionInterface
     */
    public function create(PlayerTable $table, Card $card, PlayerTable $opponentTable = null, array $complementaryCards = null): CriterionInterface {
        $noImmunityInGame = new AllPlayerTablesCriterion(new JobEffectCriteria($table, AttentatProtectionEffect::class));
        $noImmunityInGame->setErrorMessage(clienttranslate("There's a soldier watching, you can't plant a bomb safely"));
        $noImmunityInGame->addConsequence(new AttackDestinationConsequence($card, $table))
                ->addConsequence(new AttentatConsequence());
        
    }

}
