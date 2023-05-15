<?php

namespace SmileLife\Card\Core;

use Core\Decorator\DisplayModelDecorator;
use Core\Models\Core\Model;
use Core\Serializers\Serializer;
use SmileLife\Card\Card;
use SmileLife\Card\Core\Exception\CardDecoratorException;

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

    public function getSerializer(): Serializer {
        return $this->cardSerializer;
    }

    private function decorateCard(Card $card): array {
        $cardInfos = $card->__toArray();

        return $cardInfos;
    }

    protected function decorateOne(Model $model): array {
        return $this->decorateCard($model);
    }

}
