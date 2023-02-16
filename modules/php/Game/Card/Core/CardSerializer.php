<?php

namespace SmileLife\Game\Card\Core;

use Core\Models\Core\Model;
use Core\Serializers\Serializer;

/**
 * Description of CardSerializer
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class CardSerializer extends Serializer {

    protected function generateNewModel($rawItem): Model {
        if (isset($rawItem['card_class'])) {
            $className = $rawItem['card_class'];
            
            return new $className();
        }
        return parent::generateNewModel($rawItem);
    }
    
}
