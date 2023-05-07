<?php

namespace SmileLife\Card\Criterion\Factory;

use Core\Models\Player;
use SmileLife\Card\Card;
use SmileLife\Card\CardType;
use SmileLife\Card\Category\Job\Job\Bandit;
use SmileLife\Card\Category\Job\Job\Journalist;
use SmileLife\Card\Category\Job\Job\Researcher;
use SmileLife\Card\Category\Job\Job\Writer;
use SmileLife\Card\Category\Job\Official\Teacher\Teacher;
use SmileLife\Card\Category\Studies\Studies;
use SmileLife\Card\Criterion\CriterionException;
use SmileLife\Card\Criterion\CriterionInterface;
use SmileLife\Card\Criterion\GenericCriterion\CriterionGroup;
use SmileLife\Card\Criterion\GenericCriterion\InversedCriterion;
use SmileLife\Card\Criterion\JobCriterion\HaveJobCriterion;
use SmileLife\Card\Criterion\JobCriterion\JobEffectCriteria;
use SmileLife\Card\Criterion\JobCriterion\JobTypeCriterion;
use SmileLife\Card\Criterion\StudiesCriterion\StudiesLevelCriterion;
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
     * @return ?CriterionInterface
     */
    public function create(Card $card): ?CriterionInterface {
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
                throw new CriterionException("CCF-04 : Not implemented yet");
                break;
        }

        if (empty($criterias)) {
            $criterias = $this->inheritanceCriteria($card);
        }


        if (empty($criterias)) {
            return null;
        } elseif (1 === sizeof($criterias)) {
            return $criterias[0];
        } else {
            return new CriterionGroup($criterias, CriterionGroup::OR_OPERATOR);
        }
    }

    private function inheritanceCriteria(Card $card): ?CriterionInterface {
        if ($card instanceof Studies) {
            $criterias [] = new CriterionGroup([
                new HaveJobCriterion($this->table),
                new JobEffectCriteria($table, LimitlessStudiesEffect::class)
                    ], CriterionGroup::AND_OPERATOR);
            $criterias [] = new CriterionGroup([
                new InversedCriterion(new HaveJobCriterion($table)),
                new StudiesLevelCriterion($table, $card)
                    ], CriterionGroup::AND_OPERATOR);
        }
    }

}
