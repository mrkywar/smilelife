<?php

namespace SmileLife\PlayerAttributes;

use Core\Models\Player;

/**
 * Description of PlayerAttributesFactory
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
abstract class PlayerAttributesFactory {

    static public function create(Player $player): PlayerAttributes {
        $playerAttr = new PlayerAttributes();

        $playerAttr->setPlayer($player);

        return $playerAttr;
    }

}
