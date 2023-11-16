<?php

namespace SmileLife\Game\GameState;

use Core\Managers\Core\SuperManager;
use Core\Serializers\Serializer;

/**
 * Description of GameStateParamManager
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 * @ORM\Table{"name":"gamestate_param"}
 */
class GameStateParamManager extends SuperManager {

    public function findByLabel(string $label): GameStateParam {
        $gsp = parent::findBy(["label" => $label]);
        if (null === $gsp) {
            $gsp = new GameStateParam();
            $gsp->setLabel($label)
                    ->setValue(null);
            $this->create($gsp);
        }

        return $gsp;
    }

    protected function initSerializer(): Serializer {
        return new Serializer(GameStateParam::class);
    }
}
