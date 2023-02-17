<?php

namespace SmileLife\Game\Card\Core;

use SmileLife\Game\Game\GameDataRetriverException;

/**
 * Description of CardDecorator
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class CardDecorator {
    private $cardSerializer;
    
    public function __construct(CardSerializer $cardSerializer) {
        $this->cardSerializer = $cardSerializer;
    }
   
    
    public function decorateRawCard($rawCards) {
        $cards = $this->cardSerializer->unserialize($rawCards);
        if ($cards instanceof Card) {
            return [$this->cardToDisplay($cards)];
        } elseif (is_array($cards)) {
            $results = [];
            foreach ($cards as $card) {
                $results[] = $this->cardToDisplay($card);
            }
            return $results;
        } else {
            throw new GameDataRetriverException("Unsupported Arg " . get_class($cards));
        }
    }

    private function cardToDisplay(Card $card) {
        return [
            "id" => $card->getId(),
            "type" => $card->getType(),
            "smilePoints" => $card->getSmilePoints(),
            "shortclass" => $card->getVisibleClasses(),
            "location" => $card->getLocation(),
            "title" => $card->getTitle(),
            "subtitle" => $card->getSubTitle(),
            "text1" => $card->getText1(),
            "text2" => $card->getText2()
        ];
    }
}
