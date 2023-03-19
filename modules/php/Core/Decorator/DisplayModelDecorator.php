<?php
namespace Core\Decorator;

use Core\Models\Core\Model;
use Core\Serializers\Serializer;
use SmileLife\Game\Game\GameDataRetriverException;
/**
 * Description of DisplayModelDecorator
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
abstract class DisplayModelDecorator {
    
    abstract public function getSerializer(): Serializer;
    
    abstract protected function decorateOne(Model $model): array;

    public function decorate($rawItems){
         if (null === $rawItems) {
            return null;
        } elseif ($rawItems instanceof Model) { //TODO See if I can use getClassName in serializer
            return $this->decorateOne($rawItems);
        } else {
            $cards = $this->getSerializer()->unserialize($rawItems);
            if ($rawItems instanceof Model) {//TODO See if I can use getClassName in serializer
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
}
