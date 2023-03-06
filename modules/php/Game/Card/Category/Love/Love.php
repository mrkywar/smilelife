<?php

namespace SmileLife\Game\Card\Category\Love;

use SmileLife\Game\Card\Card;

/**
 * Description of Love
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
abstract class Love extends Card {

    abstract public function canGenerateChild(): bool;
}
