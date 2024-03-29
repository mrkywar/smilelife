<?php

namespace SmileLife\PlayerAttributes;

use Core\Managers\Core\SuperManager;
use Core\Managers\PlayerManager;
use Core\Models\Player;
use Core\Serializers\Serializer;

/**
 * Description of PlayerAttributesManager
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class PlayerAttributesManager extends SuperManager {

    /**
     * 
     * @var PlayerManager
     */
    private $playerManager;

    public function __construct() {
        $this->playerManager = new PlayerManager();
    }

    public function initNewGame() {
        $players = $this->playerManager->findBy();
        $playerAttrs = [];
        foreach ($players as $player) {
            $playerAttrs[] = PlayerAttributesFactory::create($player);
        }
        $this->create($playerAttrs);
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Define Abstracts Methods 
     * ---------------------------------------------------------------------- */

    protected function initSerializer(): Serializer {
        return new Serializer(PlayerAttributes::class);
    }

}
