<?php

namespace SmileLife\Card\Criterion\GenericCriterion;

use SmileLife\Card\Card;
use SmileLife\Card\Core\CardLocation;
use SmileLife\Table\PlayerTable;

/**
 * Description of CardInHandCriterion
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class CardInHandCriterion extends CardCriterion {
    /**
     * @var PlayerTable
     */
    private $table;

    public function __construct(Card $card = null, PlayerTable $table) {
        parent::__construct($card);

        $this->table = $table;
    }
    
    public function isValided(): bool {
        return parent::isValided() && (CardLocation::PLAYER_HAND === $card->getLocation() && $player->getId() === $card->getLocationArg());
    }
}
