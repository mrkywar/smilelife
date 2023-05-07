<?php

namespace SmileLife\Card\Criterion\Factory;

use Core\Models\Player;
use SmileLife\Card\Card;
use SmileLife\Card\CardType;
use SmileLife\Card\Category\Job\Job\Bandit;
use SmileLife\Card\Criterion\CriterionInterface;
use SmileLife\Card\Criterion\GenericCriterion\CriterionGroup;
use SmileLife\Card\Criterion\GenericCriterion\InversedCriterion;
use SmileLife\Card\Criterion\JobCriterion\JobTypeCriterion;
use SmileLife\Card\Criterion\PlayerTableCriterion\HaveJobCriterion;
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
                        ],CriterionGroup::AND_OPERATOR);

                break;
        }
        
        
        if(empty($criterias)){
            return null;
        }else{
            return new CriterionGroup($criterias, CriterionGroup::OR_OPERATOR);
        }
        
    }

}
