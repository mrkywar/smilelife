<?php

namespace SmileLife\Card\Core;

use Core\Decorator\DisplayModelDecorator;
use Core\Models\Core\Model;
use Core\Serializers\Serializer;
use SmileLife\Card\Card;
use SmileLife\Card\Category\Job\Job;

/**
 * Description of CardDecorator
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class CardDecorator extends DisplayModelDecorator {

    /**
     * 
     * @var CardSerializer
     */
    private $cardSerializer;

    public function __construct(CardSerializer $cardSerializer = null) {
        if (null === $cardSerializer) {
            $this->cardSerializer = new CardSerializer();
        } else {
            $this->cardSerializer = $cardSerializer;
        }
    }

    protected function decorateOne(Model $model): array {
        return $this->decorate($model);
    }

    public function getSerializer(): Serializer {
        return $this->cardSerializer;
    }

    private function decorate(Card $card) {
        $cardInfos = $card->__toArray();

        return $cardInfos;
    }

}
