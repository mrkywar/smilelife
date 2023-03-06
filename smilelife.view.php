<?php

use Core\Managers\PlayerManager;
use Core\Models\Player;
use SmileLife\Game\Card\Core\Card;
use SmileLife\Game\Card\Core\CardManager;

/**
 * ------
 * BGA framework: © Gregory Isabelli <gisabelli@boardgamearena.com> & Emmanuel Colin <ecolin@boardgamearena.com>
 * Smile Life implementation : © Jean Portemer <jportemer@mailz.org> & Mr_Kywar <mr_kywar@gmail.com>
 *
 * This code has been produced on the BGA studio platform for use on http://boardgamearena.com.
 * See http://en.boardgamearena.com/#!doc/Studio for more information.
 * -----
 *
 * smilelife.view.php
 *
 * This is your "view" file.
 *
 * The method "build_page" below is called each time the game interface is displayed to a player, ie:
 * _ when the game starts
 * _ when a player refreshes the game page (F5)
 *
 * "build_page" method allows you to dynamically modify the HTML generated for the game interface. In
 * particular, you can set here the values of variables elements defined in smilelife_smilelife.tpl (elements
 * like {MY_VARIABLE_ELEMENT}), and insert HTML block elements (also defined in your HTML template file)
 *
 * Note: if the HTML of your game interface is always the same, you don't have to place anything here.
 *
 */
require_once( APP_BASE_PATH . "view/common/game.view.php" );
require( __DIR__ . '/material.inc.php' );

class view_smilelife_smilelife extends game_view {


    function getGameName() {
        return "smilelife";
    }

//    protected function getGame(): SmileLife {
//        return SmileLife::getInstance();
//    }

    function build_page($viewArgs) {
        // Get players & players number
        $players = $this->game->loadPlayersBasicInfos();
        $players_nbr = count($players);
    }

//    function build_page($viewArgs) {
//        global $g_user;
//        $this->page->begin_block("klife_klife", "player");
//        $this->page->begin_block("klife_klife", "myhand_card");
//
//        $cardSerializer = $this->cardManager->getSerializer();
//
//        $this->tpl['MY_HAND'] = self::_("My hand");
//
//        $players = $this->playerManager->findBy();
//        $connectedPlayer = $this->playerManager->findBy([
//            "id" => $g_user->get_id()
//        ]);
//
//        $cardsInHand = $cardSerializer->unserialize(
//                $this->cardManager->getPlayerCards($connectedPlayer)
//        );
//
//        foreach ($players as $player) {
//            $this->buildPlayer($player);
//        }
//    }
//
//    private function buildPlayer(Player $player) {
//        return $this->page->insert_block("player", [
//                    'id' => $player->getId(),
//                    'color' => $player->getColor(),
//                    'name' => $player->getName(),
//        ]);
//    }
}
