<?php

namespace SmileLife\Game\PlayerAttributes;

use Core\Decorator\DisplayModelDecorator;
use Core\Serializers\Serializer;

/**
 * Description of PlayerAttributesDecorator
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class PlayerAttributesDecorator extends DisplayModelDecorator {

    protected function decorateOne(PlayerAttributes $attribute): array {
        $decorateInfo = [
            "maxCards" => $attribute->getMaxCards()
        ];

        return $decorateInfo;
    }

    public function getSerializer(): Serializer {
        return new Serializer(PlayerAttributes::class);
    }

}
