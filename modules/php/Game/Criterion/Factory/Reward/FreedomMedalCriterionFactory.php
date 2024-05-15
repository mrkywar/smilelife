<?php

namespace SmileLife\Criterion\Factory\Reward;

use SmileLife\Card\Card;
use SmileLife\Card\Category\Attack\HumanAttack;
use SmileLife\Card\Category\Job\Job\Bandit;
use SmileLife\Consequence\Category\Reward\FreedomMedalPlayedConsequence;
use SmileLife\Card\Criterion\CriterionInterface;
use SmileLife\Card\Criterion\Factory\Category\CardPlayableCriterionFactory;
use SmileLife\Card\Criterion\GenericCriterion\CardOffsidedCriterion;
use SmileLife\Card\Criterion\GenericCriterion\CriterionGroup;
use SmileLife\Card\Criterion\GenericCriterion\InversedCriterion;
use SmileLife\Card\Criterion\JobCriterion\JobTypeCriterion;
use SmileLife\Table\PlayerTable;

/**
 * Description of FreedomMedalCriterionFactory
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class FreedomMedalCriterionFactory extends CardPlayableCriterionFactory {

    public function __construct() {
        $fakeBandit = new Bandit();
        $this->message = clienttranslate('You must have a Job for this reward and you must not be a ${jobName}', ['jobName' => $fakeBandit->getTitle()]);
    }

    /**
     * 
     * @param PlayerTable $table : Game table of the player who plays
     * @param Card $card : The card that is played
     * @param PlayerTable $opponentTable : Game table of player targeted by attack (useless here)
     * @param Card[] $complementaryCards : Other cards chosen as part of purchase by example(useless here)
     * @return CriterionInterface
     */
     public function getCardCriterion(PlayerTable $table, Card $card, PlayerTable $opponentTable = null, array $complementaryCards = null): CriterionInterface {
        //-- case 1 : Not a bandit
        $fakeBandit = new Bandit();
        $banditCriterion = new InversedCriterion(new JobTypeCriterion($table, Bandit::class));
        $banditCriterion->setErrorMessage(clienttranslate('For this reward you must not be a ' . $fakeBandit->getTitle()));

        //-- case 2 : Attentat not played
        $humanAttack = new HumanAttack();
        $attentatCriterion = new InversedCriterion(new CardOffsidedCriterion($table, HumanAttack::class));
        $attentatCriterion->setErrorMessage(clienttranslate('You have played an ' . $humanAttack->getTitle() . ' you can\'t be rewarded by ' . $card->getTitle()));

        $criteria = new CriterionGroup([
            $banditCriterion,
            $attentatCriterion
                ], CriterionGroup::AND_OPERATOR);
        
        
        $criteria->addConsequence(new FreedomMedalPlayedConsequence($card, $table));

        return $criteria;
    }

}
