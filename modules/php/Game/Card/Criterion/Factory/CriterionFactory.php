<?php

namespace SmileLife\Card\Criterion\Factory;

use Core\Models\Player;
use SmileLife\Card\Card;
use SmileLife\Card\CardType;
use SmileLife\Card\Criterion\CriterionInterface;
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
     * @return CriterionInterface[]
     */
    public function create(Card $card):array{
        $criterias = [];
        
        switch ($card->getType()){
            case CardType::ATTACK_BURN_OUT:
                $criterias [] = new HaveJobCriterion($this->table);
                break;
            
            
            
            
        }
    }

}
