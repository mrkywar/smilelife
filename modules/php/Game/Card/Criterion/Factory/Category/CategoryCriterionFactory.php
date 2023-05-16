<?php

namespace SmileLife\Card\Criterion\Factory\Category;

use SmileLife\Card\Card;
use SmileLife\Table\PlayerTable;

/**
 * Description of CategoryCriterionFactory
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
abstract class CategoryCriterionFactory {

    /**
     * 
     * @var PlayerTable
     */
    private $table;

    /**
     * 
     * @var Card
     */
    private $card;

    public function __construct(PlayerTable $table, Card $card) {
        $this->table = $table;
        $this->card = $card;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    /**
     * 
     * @return ?CriterionInterface[]
     */
    abstract public function create(): ?array;

    /* -------------------------------------------------------------------------
     *                  BEGIN - Getters & Setters 
     * ---------------------------------------------------------------------- */

    public function getTable(): PlayerTable {
        return $this->table;
    }

    public function getCard(): Card {
        return $this->card;
    }

    public function setTable(PlayerTable $table) {
        $this->table = $table;
        return $this;
    }

    public function setCard(Card $card) {
        $this->card = $card;
        return $this;
    }

}
