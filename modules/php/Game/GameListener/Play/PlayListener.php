<?php

namespace SmileLife\Game\GameListener\Discard;

use Core\Event\EventListener\EventListener;
use Core\Requester\Response\Response;
use SmileLife\Card\CardManager;
use SmileLife\Card\Criterion\CriterionTester\CriterionDebugger;
use SmileLife\Card\Criterion\CriterionTester\CriterionTester;
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
        $target = $request->getTargetedPlayer();
        $table = $this->tableManager->findOneBy([
            "id" => $player->getId()
        ]);
        $opponentTable = $target;
        if (null !== $target) {
            $opponentTable = $this->tableManager->findOneBy([
                "id" => $target->getId()
            ]);
            $opponentTable->setPlayer($target);
        }

        $criteriaFactory = $card->getCriterionFactory();
        $criteria = $criteriaFactory->create($table, $card, $opponentTable);

        $criteriaTester = new CriterionTester();
        $testRestult = $criteriaTester->test($criteria);

        if (!$testRestult->isValided()) {
            throw new \BgaUserException($testRestult->getErrorMessage());
        }
//        if (!$testRestult->isValided()) {
//            var_dump($testRestult->getErrorMessage());die;
//            $debugger = new CriterionDebugger($testRestult->getCriteria());
//            $debugger->debug();
//            die("DEBUG");
//
//            throw new CardException("Not Playable");
//        }


        $table->addCard($card);
        $this->tableManager->updateTable($table);

        $response->set("from", $card->getLocation());

        $this->cardManager->playCard($player, $card);

        $response->set('player', $player)
                ->set('card', $card)
                ->set("table", $table)
                ->set('consequences', null);

        if ($testRestult->isValided()) {
            //var_dump(get_class($criteria));die;
            $response->set('consequences', $criteria->getConsequences());
        }

        return $response;
    }

    public function eventName(): string {
        return ActionType::ACTION_PLAY;
    }

    public function getPriority(): int {
        return 5;
    }

}
