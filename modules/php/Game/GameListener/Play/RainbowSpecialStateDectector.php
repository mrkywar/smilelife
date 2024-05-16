<?php

namespace SmileLife\Game\GameListener\Discard;

use Core\Event\EventListener\EventListener;
use Core\Models\Player;
use Core\Requester\Response\Response;
use SmileLife\Card\CardManager;
use SmileLife\Card\Special\Rainbow;
use SmileLife\Consequence\Special\RaindowRecaveConsequence;
use SmileLife\Game\Request\PlayCardRequest;
use SmileLife\PlayerAction\ActionType;
use SmileLife\Table\PlayerTable;
use SmileLife\Table\PlayerTableManager;

/**
 * Description of RainbowSpecialStateDectector
 *
 * @author mrKywar
 */
class RainbowSpecialStateDectector extends EventListener {

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
        $player = $request->getPlayer();
        $table = $this->retriveTable($player);
        $card = $request->getCard();
        $rainbow = $table->getRainbow();

        if (null !== $rainbow && !$card instanceof Rainbow) {
            if ($rainbow->getPassTurn() > 1) {
                $rainbow->setPassTurn($rainbow->getPassTurn() - 1);
                $this->cardManager->update($rainbow);

                $response->set("nextState", "playAgain");
            } else {
                $consequence = new RaindowRecaveConsequence($table);
                $consequence->execute($response);

                $response->set("nextState", "stopBonus");
            }
        }
    }

    protected function retriveTable(Player $player): PlayerTable {
        return $this->tableManager->findOneBy([
                    "id" => $player->getId()
        ]);
    }

    public function eventName(): string {
        return ActionType::ACTION_PLAY;
    }

    public function getPriority(): int {
        return 10;
    }
}
