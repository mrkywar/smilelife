<?php

namespace SmileLife\Game\Request;

use Core\Models\Player;
use Core\Requester\Request\Request;
use SmileLife\Card\Card;
use SmileLife\Card\CardManager;
use SmileLife\Card\CardType;
use SmileLife\Card\CardTypeException;
use SmileLife\Card\Category\Special\Birthday;
use SmileLife\PlayerAction\ActionType;
use SmileLife\Table\PlayerTableManager;

/**
 * Description of OfferWageRequest
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class OfferWageRequest extends Request {

    /**
     * 
     * @var CardManager
     */
    private $cardManager;

    /**
     * 
     * @var PlayerTableManager
     */
    private $tableManager;

    public function __construct(Player $player, Card $card) {
        parent::__construct();

        $this->cardManager = new CardManager();

        $this->tableManager = new PlayerTableManager();

        $this->set("player", $player)
                ->set("card", $card)
                ->set("birthdayOwnerTable", $this->retriveBirthdayOwnerTable());
    }

    public function getPlayer(): Player {
        return $this->get("player");
    }

    public function getCard(): Card {
        return $this->get("card");
    }

    public function getType(): string {
        return ActionType::ACTION_SPECIAL_BIRTHDAY;
    }

    public function getBirthdayOwnerTable() {
        return $this->get("birthdayOwnerTable");
    }

    private function retriveBirthdayOwnerTable() {
        $this->cardManager->getSerializer()->setIsForcedArray(false);
        $card = $this->cardManager->findBy(['type' => CardType::CARD_TYPE_BIRTHDAY], 1);
        $this->cardManager->getSerializer()->setIsForcedArray(true);

        if(! $card instanceof Birthday){
            throw new CardTypeException("OWR-64 : Something go wrong with birthday !");
        }
        $this->tableManager->getSerializer()->setIsForcedArray(false);
        $playerOwner = $this->tableManager->findBy(["id"=>$card->getLocationArg()]) ;
        $this->tableManager->getSerializer()->setIsForcedArray(true);
        echo "<pre>";
        var_dump($playerOwner,$card->getLocationArg(),$card);
        die;
    }
}
