<?php

namespace SmileLife\Game\Card\Category\Attack;

use SmileLife\Game\Card\Card;

/**
 * Description of Attack
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
abstract class Attack extends Card {

    public function canBeAttacked(): bool {
        return false;
    }

    public function canBePlayed(): bool {
        return true;
    }

    public function getSmilePoints(): int {
        return 0;
    }

}
