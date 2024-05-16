<?php

namespace SmileLife\Game\GameListener\Discard;

use Core\Event\EventListener\EventListener;
use Core\Requester\Response\Response;
use SmileLife\Card\CardManager;
use SmileLife\Criterion\Tester\CriterionTester;
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
        $additionalCards = $request->getAdditionalCards();

        $criteriaFactory = $card->getCriterionFactory();
        $criteria = $criteriaFactory->create($table, $card, $opponentTable, $additionalCards);

        $criteriaTester = new CriterionTester();
        $testRestult = $criteriaTester->test($criteria);

        if (!$testRestult->isValided()) {
            $consequences = $criteria->getInvalidConsequences();
            $response->setIsValid(false);
            if (null !== $consequences && !empty($consequences)) {
                foreach ($consequences as $consequence) {

                    $consequence->execute($response);
                }
            }
            throw new \BgaUserException($testRestult->getErrorMessage());
        }

        $response->set("from", $card->getLocation());

        $response->set('player', $player)
                ->set('card', $card)
                ->set("table", $table)
                ->set('consequences', $criteria->getConsequences());

        return $response;
    }

    public function eventName(): string {
        return ActionType::ACTION_PLAY;
    }

    public function getPriority(): int {
        return 5;
    }
}
