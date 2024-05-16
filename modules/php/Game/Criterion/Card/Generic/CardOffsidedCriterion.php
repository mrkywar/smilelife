<?php

namespace SmileLife\Criterion\Card\Generic;

use Core\Models\Player;
use SmileLife\Card\Card;
use SmileLife\Card\CardManager;
use SmileLife\Criterion\Card\PlayerTable\PlayerTableCriterion;
use SmileLife\Table\PlayerTable;

/**
 * Description of OffsidedCardCriterion
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class OffsidedCardCriterion extends PlayerTableCriterion {

    /**
     * 
     * @var string
     */
    private $className;

    /**
     * 
     * @var CardManager
     */
    private $cardManager;

    public function __construct(PlayerTable $table, string $className) {
        $this->className = $className;
        $this->cardManager = new CardManager();

        parent::__construct($table);
    }

    public function isValided(): bool {
        $cards = $this->cardManager->getAllCardsInOffside();
        $player = $this->getTable()->getPlayer();
        foreach ($cards as $card) {
            if ($this->checkCard($card, $player)) {
                return true;
            }
        }
        return false;
    }

    private function checkCard(Card $card, Player $player) {
        return (
                $card->getDiscarderId() === $player->getId() &&
                $card instanceof $this->className
                );
    }
}
