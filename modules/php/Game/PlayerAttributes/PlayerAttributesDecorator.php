<?php

namespace SmileLife\Game\PlayerAttributes;

/**
 * Description of PlayerAttributesDecorator
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class PlayerAttributesDecorator {
    
    
    public function decorate($rawItems){
         if (null === $rawItems) {
            return null;
        } elseif ($rawItems instanceof PlayerAttributes) {
            return $this->decorateOne($rawItems);
        } else {
            $cards = $this->cardSerializer->unserialize($rawItems);
            if ($rawItems instanceof PlayerAttributes) {
                return [$this->decorateOne($rawItems)];
            } elseif (is_array($rawItems)) {
                $results = [];
                foreach ($rawItems as $item) {
                    $results[] = $this->decorateOne($item);
                }
                return $results;
            } else {
                throw new GameDataRetriverException("Unsupported Arg " . get_class($item));
            }
        }
    }
    
    private function decorateOne(PlayerAttributes $attribute) {
        $decorateInfo = [
            "maxCards" => $attribute->getMaxCards()
        ];
        

        return $decorateInfo;
    }
    
    
}
