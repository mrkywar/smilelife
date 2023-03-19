<?php

namespace SmileLife\Game\PlayerAttributes;

use Core\Decorator\DisplayModelDecorator;
use Core\Models\Core\Model;
use Core\Serializers\Serializer;

/**
 * Description of PlayerAttributesDecorator
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class PlayerAttributesDecorator extends DisplayModelDecorator {

    protected function decorateOne(Model $model): array {
        return $this->doDecorartion($model);
    }

    private function doDecorartion(PlayerAttributes $attribute) {
        return [
            "maxCards" => $attribute->getMaxCards()
        ];
    }

    public function getSerializer(): Serializer {
        return new Serializer(PlayerAttributes::class);
    }

}
