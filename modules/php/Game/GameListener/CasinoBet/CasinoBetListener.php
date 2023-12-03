<?php

namespace SmileLife\Game\GameListener\CasinoBet;

use Core\Event\EventListener\EventListener;
use Core\Requester\Response\Response;
use SmileLife\Card\Card;
use SmileLife\Card\CardManager;
use SmileLife\Card\Category\Wage\Wage;
use SmileLife\Card\Criterion\GenericCriterion\CardTypeCriterion;
use SmileLife\Card\Criterion\GenericCriterion\CriterionGroup;
use SmileLife\Card\Criterion\SpecialCriterion\CasinoOpenedCriterion;
use SmileLife\Game\Request\CasinoBetRequest;
use SmileLife\PlayerAction\ActionType;
use SmileLife\Table\PlayerTable;
use SmileLife\Table\PlayerTableManager;

/**
 * Description of DiscardListener
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class CasinoBetListener extends EventListener {

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

    public function __construct() {
        $this->setMethod("onCasinoBet");

        $this->cardManager = new CardManager();
        $this->tableManager = new PlayerTableManager();
    }

    public function onCasinoBet(CasinoBetRequest &$request, Response &$response) {
        $card = $request->getCard();
        $player = $request->getPlayer();
        $table = $this->tableManager->findBy(["id" => $player->getId()]);

        $criterion = $this->getCasinoSpecialActionCriterion($card, $table);
        
        echo "<pre>";
        var_dump($request, $criterion->isValided());
        $card = $request->getCard();
        $player = $request->getPlayer();
        die('CBL');
    }

    private function getCasinoSpecialActionCriterion(Card $card, PlayerTable $table) {
        $wageCriterion = new CardTypeCriterion($card, Wage::class);
        $casinoOpened = new CasinoOpenedCriterion($table);

        return new CriterionGroup([
            $wageCriterion,
            $casinoOpened
                ], CriterionGroup::AND_OPERATOR
        );
    }

//    public function onDraw(DrawCardRequest &$request, Response &$response) {
//        $player = $request->getPlayer();
//
//        $card = $this->cardManager->drawCard();
//
//        $card->setLocation(CardLocation::PLAYER_HAND)
//                ->setLocationArg($player->getId());
//
//        $this->cardManager->moveCard($card);
//
//        $response->add("player", $player)
//                ->add("card", $card);
//
//        return $response;
//    }

    public function eventName(): string {
        return ActionType::ACTION_SPECIAL_CASINO;
    }

    public function getPriority(): int {
        return 1;
    }
}
