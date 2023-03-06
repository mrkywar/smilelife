<?php

namespace SmileLife\Game\Card\Core;

use Core\Models\Core\Model;
use Core\Serializers\Serializer;
use SmileLife\Game\Card\Card;

/**
 * Description of CardSerializer
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class CardSerializer extends Serializer {
    
    protected function generateNewModel($rawItem): Model {
        if ($rawItem instanceof Card) {
            return $rawItem;
        } elseif (isset($rawItem['card_class'])) {
            $className = $rawItem['card_class'];

            return new $className();
        } else {
            return parent::generateNewModel($rawItem);
        }
    }

}
