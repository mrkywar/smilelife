<?php

namespace SmileLife\Card\Criterion\GenericCriterion;

use Core\Models\Player;
use SmileLife\Card\Card;
use SmileLife\Card\CardManager;
use SmileLife\Card\Criterion\PlayerTableCriterion\PlayerTableCriterion;
use SmileLife\Table\PlayerTable;

/**
 * Description of CardOffsidedCriterion
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class CardOffsidedCriterion extends PlayerTableCriterion {

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
