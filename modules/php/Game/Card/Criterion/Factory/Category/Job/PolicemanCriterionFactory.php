<?php

namespace SmileLife\Card\Criterion\Factory\Category\Job;

use SmileLife\Card\Card;
use SmileLife\Card\CardManager;
use SmileLife\Card\Category\Job\Job\Bandit;
use SmileLife\Card\Category\Job\Job\Guru;
use SmileLife\Card\Consequence\Category\Attack\IllegalJobDiscardConsequence;
use SmileLife\Card\Core\CardDecorator;
use SmileLife\Card\Criterion\CriterionInterface;
use SmileLife\Table\PlayerTable;
use SmileLife\Table\PlayerTableManager;

/**
 * Description of PolicemanCriterionFactory
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class PolicemanCriterionFactory extends JobCriterionFactory {

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

        $guruTable = $this->findGuruTable();
        $banditTable = $this->findBanditTable();

        if (null !== $guruTable) {
            $guru = $guruTable->getJob();
            $criteria->addConsequence(new IllegalJobDiscardConsequence($guru, $card, $guruTable));
        }
        if (null !== $banditTable) {
            $bandit = $banditTable->getJob();
            $criteria->addConsequence(new IllegalJobDiscardConsequence($bandit, $card, $banditTable));
        }

        return $criteria;
    }

    private function findGuruTable(): ?PlayerTable {
        $tables = $this->tableManager->findBy();
        foreach ($tables as $table) {
            $guru = $table->getJob();
            if ($guru instanceof Guru) {
                return $table;
            }
        }
        return null;
    }

    private function findBanditTable(): ?PlayerTable {
        $tables = $this->tableManager->findBy();
        foreach ($tables as $table) {
            $guru = $table->getJob();
            if ($guru instanceof Bandit) {
                return $table;
            }
        }
        return null;
    }
}
