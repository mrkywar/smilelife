<?php
namespace SmileLife\Game\PlayerAction;

use SmileLife\Game\Card\Core\CardDecorator;
use SmileLife\Game\Card\Core\CardSerializer;
use SmileLife\Game\Table\PlayerTableDecorator;

/**
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
trait ResignTrait {

    public function actionResign() {
        $playerId = self::getCurrentPlayerId();
        $tableDecorator = new PlayerTableDecorator();
        $cardDecorator = new CardDecorator(new CardSerializer());

        $player = $this->playerManager->findOne([
            "id" => $playerId
        ]);
        $table = $this->tableManager->findOneBy([
            "id" => $playerId
        ]);
        $job = $table->getJob();
        
        $this->cardManager->discardCard($job, $player);

        $table->setJobId(null);
        $this->tableManager->updateTable($table);

        self::notifyAllPlayers('resignNotification', clienttranslate('${playerName} resigns from the job of ${job}'), [
            'playerId' => $playerId,
            'playerName' => $player->getName(),
            'job' => $job->getTitle(),
            'table' => $tableDecorator->decorate($table),
            'card' => $cardDecorator->decorate($job),
        ]);
        
        
        if ($job->isTemporary()) {
            $this->gamestate->nextState("resignAndPlay");
        } else {
            $this->gamestate->nextState("resignAndPass");
        }
    }

}
