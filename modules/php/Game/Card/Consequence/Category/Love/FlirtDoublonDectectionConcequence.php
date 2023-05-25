<?php

namespace SmileLife\Card\Consequence\Category\Love;

use Core\Models\Player;
use SmileLife\Card\CardManager;
use SmileLife\Card\Category\Love\Flirt\Flirt;
use SmileLife\Card\Consequence\Consequence;
use SmileLife\Card\Consequence\ConsequenceException;
use SmileLife\Card\Core\CardLocation;

/**
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class FlirtDoublonDectectionConcequence extends Consequence {

    /**
     * 
     * @var Flirt
     */
    private $card;

    /**
     * 
     * @var Player
     */
    private $player;

    /**
     * 
     * @var CardManager
     */
    private $cardManager;

    public function __construct(Flirt $card, Player $player) {
        $this->cardManager = new CardManager();
        $this->player = $player;
        $this->card = $card;
    }

    public function execute() {
        $cards = $this->cardManager->findBy([
            "type" => $this->card->getType(),
            "location" => CardLocation::PLAYER_BOARD
        ]);
        if(is_array($cards)){
            //doublon !!!
            foreach ($cards as $card){
                
            }
        }
//        echo '<pre>';
//        var_dump($cards);
//        die;
        
        throw new ConsequenceException("Consequence-FDDC : Not Yet implemented");
    }

}
