<?php

namespace SmileLife\Game\GameListener\OfferWage;

use Core\Event\EventListener\EventListener;
use Core\Requester\Response\Response;
use SmileLife\Card\CardManager;
use SmileLife\Card\Criterion\CriterionTester\CriterionTester;
use SmileLife\Card\Criterion\Factory\Category\Special\OfferWageCriterionFactory;
use SmileLife\Game\Request\OfferWageRequest;
use SmileLife\PlayerAction\ActionType;
use SmileLife\Table\PlayerTableManager;

/**
 * Description of DiscardListener
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class OfferWageListener extends EventListener {

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
    
    /**
     * 
     * @var OfferWageCriterionFactory
     */
    private $criterionFactory;

    public function __construct() {
        $this->setMethod("onOfferWage");

        $this->cardManager = new CardManager();
        $this->tableManager = new PlayerTableManager();
        $this->criterionFactory = new OfferWageCriterionFactory();
        
    }

    public function onOfferWage(OfferWageRequest &$request, Response &$response) {
        $card = $request->getCard();
        $player = $request->getPlayer();
        $table = $this->tableManager->findBy(["id" => $player->getId()]);
        $opponent = $request->getBirthdayOwnerTable();

        $criterion = $this->criterionFactory->create($table, $card, $opponent);

        $criteriaTester = new CriterionTester();
        $testRestult = $criteriaTester->test($criterion);

        if (!$testRestult->isValided()) {
            throw new \BgaUserException($testRestult->getErrorMessage());
        }

        $response->set("from", $card->getLocation());

        $response->set('player', $player)
                ->set('card', $card)
                ->set("table", $table)
                ->set('consequences', $criterion->getConsequences());
    }

    public function eventName(): string {
        return ActionType::ACTION_SPECIAL_BIRTHDAY;
    }

    public function getPriority(): int {
        return 1;
    }
}
