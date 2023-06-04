<?php

namespace Core\Managers;

use Core\DB\Fields\DBFieldsRetriver;
use Core\Managers\Core\SuperManager;
use Core\Models\Player;
use Core\Serializers\Serializer;
use SmileLife;

/**
 * Description of PlayerManager
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class PlayerManager extends SuperManager {

    public function initNewGame(array $rawPlayers, array $options = []) {
        $gameinfos = SmileLife::getInstance()->getGameinfos();

        $players = $this->getSerializer()->unserialize($rawPlayers);

        $defaultColors = $gameinfos['player_colors'];
        foreach ($players as &$player) {
            $color = array_shift($defaultColors);
            $player->setColor($color);
        }
        $this->create($players);

        SmileLife::getInstance()->reattributeColorsBasedOnPreferences($rawPlayers, $gameinfos['player_colors']);
        SmileLife::getInstance()->reloadPlayersBasicInfos();
    }
    
    
    public function findOne(array $criterias): ?Player {
        $player = $this->findBy($criterias, 1);
        
        return $player;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Score Methods
     * ---------------------------------------------------------------------- */

    public function updateScore(Player $player) {
        return $this->update($player);
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Define Abstracts Methods 
     * ---------------------------------------------------------------------- */

    protected function initSerializer(): Serializer {
        return new Serializer(Player::class);
    }

}
