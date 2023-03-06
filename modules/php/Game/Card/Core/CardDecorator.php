<?php

namespace SmileLife\Game\Card\Core;

use SmileLife\Game\Card\Card;
use SmileLife\Game\Card\Category\Job\Job;
use SmileLife\Game\Game\GameDataRetriverException;

/**
 * Description of CardDecorator
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class CardDecorator {

    /**
     * 
     * @var CardSerializer
     */
    private $cardSerializer;

    public function __construct(CardSerializer $cardSerializer) {
        $this->cardSerializer = $cardSerializer;
    }

    public function decorateRawCard($rawCards) {
        if (null === $rawCards) {
            return null;
        } elseif ($rawCards instanceof Card) {
            return $this->decorateOne($rawCards);
        } else {
            $cards = $this->cardSerializer->unserialize($rawCards);
            if ($cards instanceof Card) {
                return [$this->decorateOne($cards)];
            } elseif (is_array($cards)) {
                $results = [];
                foreach ($cards as $card) {
                    $results[] = $this->decorateOne($card);
                }
                return $results;
            } else {
                throw new GameDataRetriverException("Unsupported Arg " . get_class($cards));
            }
        }
    }

    private function decorateOne(Card $card) {
        $cardInfos = [
            "id" => $card->getId(),
            "type" => $card->getType(),
            "smilePoints" => $card->getSmilePoints(),
            "shortclass" => $card->getVisibleClasses(),
            "location" => $card->getLocation(),
            "title" => $card->getTitle(),
            "subtitle" => $card->getSubTitle(),
            "text1" => $card->getText1(),
            "text2" => $card->getText2(),
            "isFlipped" => $card->getIsFlipped(),
        ];
        if ($card instanceof Job) {
            $cardInfos = array_merge($cardInfos, $this->decorateJob($card));
        }

        return $cardInfos;
    }

    private function decorateJob(Job $card) {
        return [
            "isTemporary" => $card->isTemporary(),
            "isOfficial" => $card->isOfficial(),
            "requiredStudies" => $card->getRequiredStudies(),
            "maxSalary" => $card->getMaxSalary()
        ];
    }

}
