<?php

namespace SmileLife\Card\Criterion\GenericCriterion;

use SmileLife\Card\Card;
use SmileLife\Card\CardManager;
use SmileLife\Card\Core\CardLocation;
use SmileLife\Table\PlayerTable;

/**
 * Description of CardIsLastDiscardedCriterion
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class CardIsLastDiscardedCriterion extends CardCriterion {

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
