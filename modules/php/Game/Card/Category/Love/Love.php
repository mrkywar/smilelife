<?php

namespace SmileLife\Card\Category\Love;

use SmileLife\Card\Card;

/**
 * Description of Love
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
abstract class Love extends Card {

    abstract public function canGenerateChild(): bool;

    public function __toArray(): array {
        return array_merge(
                parent::__toArray(),
                [
                    'generateChild' => (int) $this->canGenerateChild()
                ]
        );
    }

}
