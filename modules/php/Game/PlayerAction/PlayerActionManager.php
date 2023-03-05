<?php

namespace SmileLife\Game\PlayerAction;

use SmileLife\Game\Game\GameDataRetriver;

/**
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class PlayerActionManager {

    /**
     * 
     * @var GameDataRetriver
     */
    private $dataRetriver;

    public function __construct(GameDataRetriver $dataRetriver) {
        $this->dataRetriver = $dataRetriver;
    }

    public function actionResign($playerId) {
        $player = $this->dataRetriver
                ->getPlayerManager()
                ->findOne(
                [
                    "id" => $playerId
                ]
        );

        var_dump($player);
    }

}
