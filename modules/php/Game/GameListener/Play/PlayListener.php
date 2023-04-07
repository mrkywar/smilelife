<?php

namespace SmileLife\Game\GameListener\Discard;

use Core\Event\EventListener\EventListener;
use Core\Requester\Response\Response;
use Exception;
use SmileLife\Card\CardManager;
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
//

        if ($card->canBePlayed()) {
            $this->cardManager->playCard($player, $card);
            $response->set('player', $player)
                    ->set('card', $card);
        } else {
            $response->set("isPlayerd", false);
            var_dump($card, $card->canBePlayed());
            throw new Exception("Unplayable Card");
        }
//        var_dump($card->canBePlayed());
//        die;
//        $this->cardManager->discardCard($card, $request->getPlayer());
//        $response->set('card', $card);

        return $response;
    }

    public function eventName(): string {
        return ActionType::ACTION_PLAY;
    }

    public function getPriority(): int {
        return 5;
    }

}
