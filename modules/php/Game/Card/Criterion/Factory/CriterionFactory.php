<?php

namespace SmileLife\Card\Criterion\Factory;

use SmileLife\Card\Card;
use SmileLife\Card\CardType;
use SmileLife\Card\Category\Acquisition\House\House;
use SmileLife\Card\Category\Acquisition\Travel\Travel;
use SmileLife\Card\Category\Child\Child;
use SmileLife\Card\Category\Job\Job;
use SmileLife\Card\Category\Job\Job\Bandit;
use SmileLife\Card\Category\Job\Job\Journalist;
use SmileLife\Card\Category\Job\Job\Researcher;
use SmileLife\Card\Category\Job\Job\Writer;
use SmileLife\Card\Category\Job\Official\Official;
use SmileLife\Card\Category\Job\Official\Teacher\Teacher;
use SmileLife\Card\Category\Love\Adultery;
use SmileLife\Card\Category\Love\Flirt\Flirt;
use SmileLife\Card\Category\Love\Marriage\Marriage;
use SmileLife\Card\Category\Studies\Studies;
use SmileLife\Card\Category\Wage\Wage;
use SmileLife\Card\Criterion\CriterionException;
use SmileLife\Card\Criterion\GenericCriterion\CriterionGroup;
use SmileLife\Card\Criterion\GenericCriterion\InversedCriterion;
use SmileLife\Card\Criterion\JobCriterion\HaveJobCriterion;
use SmileLife\Card\Criterion\JobCriterion\JobEffectCriteria;
use SmileLife\Card\Criterion\JobCriterion\JobStudiesCriterion;
use SmileLife\Card\Criterion\JobCriterion\JobTypeCriterion;
use SmileLife\Card\Criterion\JobCriterion\WageCriterion;
use SmileLife\Card\Criterion\LoveCriterion\FlirtCountCriterion;
use SmileLife\Card\Criterion\LoveCriterion\FlirtPlayedCriterion;
use SmileLife\Card\Criterion\LoveCriterion\HaveAdulteryCriterion;
use SmileLife\Card\Criterion\LoveCriterion\IsMarriedCriterion;
use SmileLife\Card\Criterion\LoveCriterion\LastFlirtGenerateChildCiterion;
use SmileLife\Card\Criterion\StudiesCriterion\StudiesLevelCriterion;
use SmileLife\Card\Effect\Category\LimitlessFlirt;
use SmileLife\Card\Effect\Category\LimitlessStudiesEffect;
use SmileLife\Card\Effect\Category\SicknessImunueEffect;
use SmileLife\Table\PlayerTable;

/**
 * Description of CriterionFactory
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class CriterionFactory implements CriterionFactoryInterface{

    /**
     * 
     * @var PlayerTable
     */
    private PlayerTable $table;

    /**
     * 
     * @var Card[]|null
     */
    private ?array $complementaryCards;

    /**
     * 
     * @var PlayerTable|null
     */
    private ?PlayerTable $opponentTable;

    public function __construct(PlayerTable $table, Card $card, ?PlayerTable $opponentTable = null, ?array $complementaryCards = null) {
        $this->table = $table;
        $this->card = $card;
        $this->complementaryCards = $complementaryCards;
        $this->opponentTable = $opponentTable;
    }

    /**
     * 
     * @return ?CriterionInterface[]
     */
    public function create(): ?array {
        $criterias = array_merge(
                $this->typeCriteria($this->card),
                $this->inheritanceCriteria($this->card)
        );

        if (empty($criterias)) {
            return null;
        } /* elseif (1 === sizeof($criterias)) {
          return $criterias[0];
          } else {
          return new CriterionGroup($criterias, CriterionGroup::OR_OPERATOR);
          } */ else {
            return $criterias;
        }
    }

    private function typeCriteria(Card $card) {
        $factory = null;

        switch ($card->getType()) {
            case CardType::REWARD_FREEDOM_MEDAL:
                $factory = new Category\FreedomMedalCriterionFactory($this->table, $card);
                break;
            case CardType::JOB_GRAND_PROF:
                $factory = new Category\GrandProfCriterionFactory($this->table, $card);
                break;
            case CardType::REWARD_NATIONAL_MEDAL:
                $factory = new Category\NationalMedalCriterionFactory($this->table, $card);
                break;
            case CardType::ATTACK_DISMISSAL:
                $factory = new Category\DismissalCriterionFactory($this->opponentTable, $card);
                break;
            case CardType::ATTACK_BURN_OUT:
                $factory = new Category\BurnOutCriterionFactory($this->opponentTable, $card);
                break;
            case CardType::ATTACK_DISMISSAL:
                $factory = new Category\SicknessCriterionFactory($this->opponentTable, $card);
                break;
            case CardType::STUDY_DOUBLE:
            case CardType::STUDY_SINGLE:
                $factory = new Category\StudieCriterionFactory($this->table, $card);
                break;
            case CardType::WAGE_LEVEL_1:
            case CardType::WAGE_LEVEL_2:
            case CardType::WAGE_LEVEL_3:
            case CardType::WAGE_LEVEL_4:
                $factory = new Category\WageCriterionFactory($this->table, $card);
                break;
        }

        if (null === $factory) {
            
        }



        //-- V1 !
        $criterias = [];

        switch ($card->getType()) {
//            case CardType::REWARD_FREEDOM_MEDAL:
//                $criterias [] = new CriterionGroup([
//                    new HaveJobCriterion($this->table),
//                    new InversedCriterion(new JobTypeCriterion($this->table, Bandit::class))
//                        ], CriterionGroup::AND_OPERATOR);
//
//                break;
//            case CardType::JOB_GRAND_PROF:
//                $criterias [] = new JobTypeCriterion($this->table, Teacher::class);
//                break;
//            case CardType::REWARD_NATIONAL_MEDAL:
//                $criterias [] = new JobTypeCriterion($this->table, Writer::class);
//                $criterias [] = new JobTypeCriterion($this->table, Researcher::class);
//                $criterias [] = new JobTypeCriterion($this->table, Journalist::class);
//                break;
            case CardType::JOB_GURU:
            case CardType::JOB_BANDIT:
                throw new CriterionException("CCF-01 : Not implemented yet");
                break;
            case CardType::ATTACK_HUMAN_ATTACK:
                throw new CriterionException("CCF-02 : Not implemented yet");
                break;
            case CardType::ATTACK_ACCIDENT:
                throw new CriterionException("CCF-03 : Not implemented yet");
                break;
            case CardType::ATTACK_DIVORCE:
                throw new CriterionException("CCF-04 : Not implemented yet");
                break;
//            case CardType::ATTACK_DISMISSAL:
//                $criterias[] = new CriterionGroup([
//                    new HaveJobCriterion($this->opponentTable),
//                    new InversedCriterion(new JobTypeCriterion($this->opponentTable, Official::class))
//                        ], CriterionGroup::AND_OPERATOR);
//                break;
//            case CardType::ATTACK_BURN_OUT:
//                $criterias[] = new HaveJobCriterion($this->opponentTable);
//                break;
            case CardType::ATTACK_GRADE_REPETITION:
                throw new CriterionException("CCF-08 : Not implemented yet");
                break;
            case CardType::ATTACK_INCOME_TAX:
                throw new CriterionException("CCF-09 : Not implemented yet");
                break;
            case CardType::ATTACK_JAIL:
                throw new CriterionException("CCF-10 : Not implemented yet");
                break;
//            case CardType::ATTACK_SICKNESS:
//                $criterias[] = new InversedCriterion(new HaveJobCriterion($this->opponentTable));
//                $criterias[] = new CriterionGroup([
//                    new HaveJobCriterion($this->opponentTable),
//                    new InversedCriterion(new JobEffectCriteria($this->opponentTable, SicknessImunueEffect::class))
//                        ], CriterionGroup::AND_OPERATOR);
//                break;
            case CardType::SPECIAL_BIRTHDAY:
                throw new CriterionException("CCF-12 : Not implemented yet");
                break;
            case CardType::SPECIAL_JOB_BOOST:
                throw new CriterionException("CCF-13 : Not implemented yet");
                break;
            case CardType::SPECIAL_REVENGE:
                throw new CriterionException("CCF-14 : Not implemented yet");
                break;
            case CardType::SPECIAL_SHOOTING_STAR:
                throw new CriterionException("CCF-15 : Not implemented yet");
                break;
        }
        return $criterias;
    }

    private function inheritanceCriteria(Card $card): array {
        $criterias = [];
        if ($card instanceof Studies) {
//            $criterias [] = new JobEffectCriteria($this->table, LimitlessStudiesEffect::class);
//            $criterias [] = new CriterionGroup([
//                new InversedCriterion(new HaveJobCriterion($this->table)),
//                new StudiesLevelCriterion($this->table, $card)
//                    ], CriterionGroup::AND_OPERATOR);
        } elseif ($card instanceof Wage) {
//            $criterias [] = new CriterionGroup([
//                new HaveJobCriterion($this->table),
//                new WageCriterion($this->table, $card)
//                    ], CriterionGroup::AND_OPERATOR);
        } elseif ($card instanceof House) {
            throw new CriterionException("CCF-06 : Not implemented yet");
        } elseif ($card instanceof Travel) {
            throw new CriterionException("CCF-07 : Not implemented yet");
        } elseif ($card instanceof Job) {
            $criterias [] = new CriterionGroup([
                new InversedCriterion(new HaveJobCriterion($this->table)),
                new JobStudiesCriterion($this->table, $card)
                    ], CriterionGroup::AND_OPERATOR);
        } elseif ($card instanceof Child) {
            $criterias [] = new IsMarriedCriterion($this->table);
            $criterias [] = new LastFlirtGenerateChildCiterion($this->table);
        } elseif ($card instanceof Flirt) {
            $criterias [] = new HaveAdulteryCriterion($this->table);
            $criterias [] = new CriterionGroup([
                new InversedCriterion(new IsMarriedCriterion($this->table)),
                new CriterionGroup([
                    new FlirtCountCriterion($this->table),
                    new JobEffectCriteria($this->table, LimitlessFlirt::class)
                        ], CriterionGroup::OR_OPERATOR)
                    ], CriterionGroup::AND_OPERATOR);
        } elseif ($card instanceof Marriage) {
            $criterias [] = new CriterionGroup([
                new InversedCriterion(new IsMarriedCriterion($this->table)),
                new FlirtPlayedCriterion($this->table, $card)
                    ], CriterionGroup::AND_OPERATOR);
        } elseif ($card instanceof Adultery) {
            $criterias [] = new CriterionGroup([
                new InversedCriterion(new HaveAdulteryCriterion($this->table)),
                new IsMarriedCriterion($this->table)
                    ], CriterionGroup::AND_OPERATOR);
        }

        return $criterias;
    }

}
