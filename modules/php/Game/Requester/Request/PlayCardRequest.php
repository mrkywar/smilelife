<?php

namespace SmileLife\Requester\Request;

/**
 * Description of PlayCardRequest
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class PlayCardRequest extends Request {

    private const PLAYER_PARAM = "player";
    private const CARD_PARAM = "card";
    

    public function __construct(Player $player, Card $card) {
        parent::__construct();

        $this->add(self::PLAYER_PARAM, $player)
                ->add(self::CARD_PARAM, $card)
                ->setType($type);
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Shortcut
     * ---------------------------------------------------------------------- */

    /**
     * 
     * @return Player
     */
    public function getPlayer() {
        return $this->get(self::PLAYER_PARAM);
    }

    /**
     * 
     * @return Card
     */
    public function getCard() {
        return $this->get(self::CARD_PARAM);
    }

}
