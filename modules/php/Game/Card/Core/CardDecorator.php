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
        return $this->doDecorate($model);
    }

    public function getSerializer(): Serializer {
        return $this->cardSerializer;
    }

    private function doDecorate(Card $card) {
        $cardInfos = [
            "id" => $card->getId(),
            "type" => $card->getType(),
            "category" => $card->getCategory(),
            "name" => $card->getName(),
            "smilePoints" => $card->getSmilePoints(),
            "location" => $card->getLocation(),
            "title" => $card->getTitle(),
            "subtitle" => $card->getSubTitle(),
            "text1" => $card->getText1(),
            "text2" => $card->getText2(),
            "isFlipped" => $card->getIsFlipped(),
        ];
        if ($card instanceof Job) {
            $cardInfos = array_merge($cardInfos, $this->doDecorateJob($card));
        }

        return $cardInfos;
    }

    private function doDecorateJob(Job $card) {
        return [
            "isTemporary" => $card->isTemporary(),
            "isOfficial" => $card->isOfficial(),
            "requiredStudies" => $card->getRequiredStudies(),
            "maxSalary" => $card->getMaxSalary()
        ];
    }

}
