<?php

namespace SmileLife\Game\GameListener\CasinoBet;

use Core\Event\EventListener\EventListener;
use Core\Requester\Response\Response;
use SmileLife\Card\CardManager;
use SmileLife\Card\Criterion\CriterionTester\CriterionTester;
use SmileLife\Card\Criterion\Factory\Category\Special\CasinoBetCriterionFactory;
use SmileLife\Game\Request\CasinoBetRequest;
use SmileLife\PlayerAction\ActionType;
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
    
    /**
     * 
     * @var CasinoBetCriterionFactory
     */
    private $criterionFactory;

    public function __construct() {
        $this->setMethod("onCasinoBet");

        $this->cardManager = new CardManager();
        $this->tableManager = new PlayerTableManager();
        $this->criterionFactory = new CasinoBetCriterionFactory();
        
    }

    public function onCasinoBet(CasinoBetRequest &$request, Response &$response) {
        $card = $request->getCard();
        $player = $request->getPlayer();
        $table = $this->tableManager->findBy(["id" => $player->getId()]);

        $criterion = $this->criterionFactory->create($table, $card);

        $criteriaTester = new CriterionTester();
        $testRestult = $criteriaTester->test($criterion);

        if (!$testRestult->isValided()) {
            throw new \BgaUserException($testRestult->getErrorMessage());
        }

        echo '<pre>';
        
        echo "??";
        var_dump($criterion->getConsequences());
        die;

        $response->set("from", $card->getLocation());

        $response->set('player', $player)
                ->set('card', $card)
                ->set("table", $table)
                ->set('consequences', null)
                ->set('consequences', $criterion->getConsequences());
    }

    public function eventName(): string {
        return ActionType::ACTION_SPECIAL_CASINO;
    }

    public function getPriority(): int {
        return 1;
    }
}
