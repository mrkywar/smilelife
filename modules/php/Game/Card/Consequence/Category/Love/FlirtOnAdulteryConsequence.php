<?php

namespace SmileLife\Card\Consequence\Category\Love;

use Core\Requester\Response\Response;
use SmileLife\Card\CardManager;
use SmileLife\Card\Category\Love\Flirt\Flirt;
use SmileLife\Card\Consequence\Consequence;
use SmileLife\Card\Core\CardPile;
use SmileLife\Table\PlayerTable;

/**
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class FlirtOnAdulteryConsequence extends Consequence {

    /**
     * 
     * @var Flirt
     */
    private $card;

    /**
     * 
     * @var PlayerTable
     */
    private $table;

    /**
     * 
     * @var CardManager
     */
    private $cardManager;

    public function __construct(Flirt $card, PlayerTable $table) {
        $this->cardManager = new CardManager();
        $this->table = $table;
        $this->card = $card;
    }

    public function execute(Response &$response) {
        $card = $response->get("card");
        $card->setPileName(CardPile::PILE_ADULTERY);
        $card = $response->set("card", $card);
    }

}
