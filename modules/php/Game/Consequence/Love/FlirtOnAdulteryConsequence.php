<?php

namespace SmileLife\Consequence\Love;

use Core\Requester\Response\Response;
use SmileLife\Card\CardManager;
use SmileLife\Card\Category\Love\Flirt\Flirt;
use SmileLife\Consequence\PlayerTableConsequence;
use SmileLife\Card\Core\CardPile;
use SmileLife\Table\PlayerTable;

/**
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class FlirtOnAdulteryConsequence extends PlayerTableConsequence {

    /**
     * 
     * @var Flirt
     */
    private $card;

    /**
     * 
     * @var CardManager
     */
    private $cardManager;

    public function __construct(Flirt $card, PlayerTable $table) {
        parent::__construct($table);

        $this->cardManager = new CardManager();
        $this->card = $card;
    }

    public function execute(Response &$response) {
        $card = $response->get("card");
        $card->setPileName(CardPile::PILE_ADULTERY);
        $card = $response->set("card", $card);
    }

}
