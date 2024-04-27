<?php

namespace SmileLife\Card\Criterion\Factory\Category\Job;

use SmileLife\Card\Card;
use SmileLife\Card\CardManager;
use SmileLife\Card\Consequence\Category\Job\JournalistVisionConsequence;
use SmileLife\Card\Core\CardDecorator;
use SmileLife\Card\Criterion\CriterionInterface;
use SmileLife\Table\PlayerTable;
use SmileLife\Table\PlayerTableManager;

/**
 * Description of JournalistCriterionFactory
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class JournalistCriterionFactory extends JobCriterionFactory {

    /**
     * 
     * @var PlayerTableManager
     */
    private $tableManager;

    /**
     * 
     * @var CardManager
     */
    protected $cardManager;

    /**
     * 
     * @var CardDecorator
     */
    protected $cardDecorator;

    public function __construct() {

        $this->tableManager = new PlayerTableManager();
        $this->cardManager = new CardManager();
        $this->cardDecorator = new CardDecorator();
    }

    /**
     * 
     * @param PlayerTable $table : Game table of the player who plays
     * @param Card $card : The card that is played
     * @param PlayerTable $opponentTable : Game table of player targeted by attack (useless here)
     * @param Card[] $complementaryCards : Other cards chosen as part of purchase by example(useless here)
     * @return CriterionInterface
     */
    public function getCardCriterion(PlayerTable $table, Card $card, PlayerTable $opponentTable = null, Card $complementaryCards = null): CriterionInterface {
        $criteria = parent::getCardCriterion($table, $card, $opponentTable, $complementaryCards);

        $criteria->addConsequence(new JournalistVisionConsequence($card, $table));

        return $criteria;
    }
}
