<?php

namespace SmileLife\Card\Criterion\Factory;

use Core\Models\Player;
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
use SmileLife\Card\Category\Job\Official\Teacher\Teacher;
use SmileLife\Card\Category\Love\Flirt\Flirt;
use SmileLife\Card\Category\Studies\Studies;
use SmileLife\Card\Category\Wage\Wage;
use SmileLife\Card\Criterion\CriterionException;
use SmileLife\Card\Criterion\CriterionInterface;
use SmileLife\Card\Criterion\GenericCriterion\CriterionGroup;
use SmileLife\Card\Criterion\GenericCriterion\InversedCriterion;
use SmileLife\Card\Criterion\JobCriterion\HaveJobCriterion;
use SmileLife\Card\Criterion\JobCriterion\JobEffectCriteria;
use SmileLife\Card\Criterion\JobCriterion\JobTypeCriterion;
use SmileLife\Card\Criterion\JobCriterion\WageCriterion;
use SmileLife\Card\Criterion\LoveCriterion\FlirtCountCriterion;
use SmileLife\Card\Criterion\LoveCriterion\HaveAdulteryCriterion;
use SmileLife\Card\Criterion\LoveCriterion\IsMarriedCriterion;
use SmileLife\Card\Criterion\LoveCriterion\LastFlirtGenerateChildCiterion;
use SmileLife\Card\Criterion\StudiesCriterion\StudiesLevelCriterion;
use SmileLife\Card\Effect\Category\LimitlessFlirt;
use SmileLife\Card\Effect\Category\LimitlessStudiesEffect;
use SmileLife\Table\PlayerTable;

/**
 * Description of CriterionFactory
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class CriterionFactory {

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
     * @var Player|null
     */
    private ?Player $opponent;

    public function __construct(PlayerTable $table, ?array $complementaryCards = null, ?Player $opponent = null) {
        $this->table = $table;
        $this->complementaryCards = $complementaryCards;
        $this->opponent = $opponent;
    }

    /**
     * 
     * @param Card $card
     * @return ?CriterionInterface[]
     */
    public function create(Card $card): ?CriterionInterface {
        $criterias = array_merge(
                $this->typeCriteria($card),
                $this->inheritanceCriteria($card)
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
        $criterias = [];
        switch ($card->getType()) {
            case CardType::ATTACK_BURN_OUT:
                $criterias [] = new HaveJobCriterion($this->table);
                break;
            case CardType::REWARD_FREEDOM_MEDAL:
                $criterias [] = new CriterionGroup([
                    new HaveJobCriterion($this->table),
                    new InversedCriterion(new JobTypeCriterion($this->table, Bandit::class))
                        ], CriterionGroup::AND_OPERATOR);

                break;
            case CardType::JOB_GRAND_PROF:
                $criterias [] = new JobTypeCriterion($this->table, Teacher::class);
                break;
            case CardType::REWARD_NATIONAL_MEDAL:
                $criterias [] = new JobTypeCriterion($this->table, Writer::class);
                $criterias [] = new JobTypeCriterion($this->table, Researcher::class);
                $criterias [] = new JobTypeCriterion($this->table, Journalist::class);
                break;
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
            case CardType::ATTACK_DISMISSAL:
                throw new CriterionException("CCF-05 : Not implemented yet");
                break;
        }
    }

    private function inheritanceCriteria(Card $card): array {
        $criterias = [];
        if ($card instanceof Studies) {
            $criterias [] = new JobEffectCriteria($this->table, LimitlessStudiesEffect::class);
            $criterias [] = new CriterionGroup([
                new InversedCriterion(new HaveJobCriterion($this->table)),
                new StudiesLevelCriterion($this->table, $card)
                    ], CriterionGroup::AND_OPERATOR);
        } elseif ($card instanceof Wage) {
            $criterias [] = new CriterionGroup([
                new HaveJobCriterion($this->table),
                new WageCriterion($this->table, $card)
                    ], CriterionGroup::AND_OPERATOR);
        } elseif ($card instanceof House) {
            throw new CriterionException("CCF-06 : Not implemented yet");
        } elseif ($card instanceof Travel) {
            throw new CriterionException("CCF-07 : Not implemented yet");
        } elseif ($card instanceof Job) {
            $criterias [] = new CriterionGroup([
                new InversedCriterion(new HaveJobCriterion($this->table)),
                new StudiesLevelCriterion($this->table, $card)
                    ], CriterionGroup::AND_OPERATOR);
        } elseif ($card instanceof Child) {
            $criterias [] = new IsMarriedCriterion($this->table);
            $criterias [] = new LastFlirtGenerateChildCiterion($this->table);
        } elseif ($card instanceof Flirt) {
            $criterias [] = new HaveAdulteryCriterion($this->table);
            $criterias [] = new CriterionGroup([
                new InversedCriterion(new IsMarriedCriterion($this->table)),
                new CriterionGroup([
                    new FlirtCountCriterion($table),
                    new JobEffectCriteria($this->table, LimitlessFlirt::class)
                        ], CriterionGroup::OR_OPERATOR)
                    ], CriterionGroup::AND_OPERATOR);
        }

        return $criterias;
    }

}
