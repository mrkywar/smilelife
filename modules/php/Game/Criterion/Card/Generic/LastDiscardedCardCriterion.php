<?php

namespace SmileLife\Criterion\Card\Generic;

use SmileLife\Card\Card;
use SmileLife\Card\CardManager;
use SmileLife\Card\Core\CardLocation;
use SmileLife\Table\PlayerTable;

/**
 * Description of LastDiscardedCardCriterion
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class LastDiscardedCardCriterion extends CardCriterion {

    /**
     * @var PlayerTable
     */
    private $table;

    /**
     * 
     * @var CardManager
     */
    private $cardManager;

    public function __construct(Card $card = null, PlayerTable $table) {
        parent::__construct($card);

        $this->table = $table;
        $this->cardManager = new CardManager();
    }

    public function isValided(): bool {
        $card = $this->cardManager->getLastDiscardedCard();
        $player = $this->table->getPlayer();

        if (null === $card || CardLocation::DISCARD !== $this->getCard()->getLocation()) {
            return false;
        } else {
            return ($card->getDiscarderId() !== $player->getId() && $card->getId() === $this->getCard()->getId()) && parent::isValided();
        }
    }
}
