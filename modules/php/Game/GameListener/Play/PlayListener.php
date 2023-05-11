<?php

namespace SmileLife\Game\GameListener\Discard;

use Core\Event\EventListener\EventListener;
use Core\Requester\Response\Response;
use SmileLife\Card\CardManager;
use SmileLife\Card\Core\Exception\CardException;
use SmileLife\Card\Criterion\CriterionTest\CriterionDebugger;
use SmileLife\Card\Criterion\CriterionTest\CriterionTest;
use SmileLife\Game\Request\PlayCardRequest;
use SmileLife\PlayerAction\ActionType;
use SmileLife\Table\PlayerTableManager;

/**
 * Description of PlayListener
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class PlayListener extends EventListener {

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
        $this->setMethod("onPlay");

        $this->cardManager = new CardManager();
        $this->tableManager = new PlayerTableManager();
    }

    public function onPlay(PlayCardRequest &$request, Response &$response) {
        $card = $request->getCard();
        $player = $request->getPlayer();
        $table = $this->tableManager->findOneBy([
            "id" => $player->getId()
        ]);

        $criteriaTest = new CriterionTest($table, $card);
        $testRestult = $criteriaTest->test();
////        $card = new FreedomMedal();
//        $criterionFactory = new CriterionFactory($table);
//        $criteria = $criterionFactory->create($card);


        if (!$testRestult->getIsValid()) {
            echo '<pre>';

//            var_dump($testRestult->getCriteria());
            $debugger = new CriterionDebugger($testRestult->getCriteria());
            $debugger->debug();
            die("DEBUG");

            throw new CardException("Not Playable");
        }
//        $card->canBePlayed($table);

        $table->addCard($card);
        $this->tableManager->updateTable($table);

        $response->set("from", $card->getLocation());

        $this->cardManager->playCard($player, $card);

        $response->set('player', $player)
                ->set('card', $card)
                ->set("table", $table);

        return $response;
    }

    public function eventName(): string {
        return ActionType::ACTION_PLAY;
    }

    public function getPriority(): int {
        return 5;
    }

}
