<?php

/**
 * ------
 * BGA framework: © Gregory Isabelli <gisabelli@boardgamearena.com> & Emmanuel Colin <ecolin@boardgamearena.com>
 * Smile Life implementation : © Jean Portemer <jportemer@mailz.org> & Mr_Kywar <mr_kywar@gmail.com>
 *
 * This code has been produced on the BGA studio platform for use on http://boardgamearena.com.
 * See http://en.boardgamearena.com/#!doc/Studio for more information.
 * -----
 * 
 * states.inc.php
 *
 * Smile Life game states description
 *
 */
require_once("modules/constants.inc.php");

$basicGameStates = [
    // The initial state. Please do not modify.
    ST_GAME_SETUP => [
        "name" => "gameSetup",
        "description" => clienttranslate("Game setup"),
        "type" => "manager",
        "action" => "stGameSetup",
        "transitions" => ["" => ST_PLAYER_TAKE_CARD]
    ],
    // Final state.
    // Please do not modify.
    ST_GAME_END => [
        "name" => "gameEnd",
        "description" => clienttranslate("End of game"),
        "type" => "manager",
        "action" => "stGameEnd",
        "args" => "argGameEnd",
    ],
];

$playerActionsGameStates = [
    ST_PLAYER_TAKE_CARD => [
        "name" => "takeCard",
        "description" => clienttranslate('${actplayer} must choose an action'),
        "descriptionmyturn" => clienttranslate('${you} must choose an action'),
        "type" => "activeplayer",
//        "args" => "argTakeCards",
        "updateGameProgression" => true,
        "possibleactions" => [
            "resignAndPlay",
            "resignAndPass",
            "drawCardFormDeck",
            "drawCardFormDiscard"
        ],
        "transitions" => [
            "resignAndPlay" => ST_PLAYER_TAKE_CARD,
            "resignAndPass" => ST_NEXT_PLAYER,
            "drawCardFormDeck" => ST_PLAYER_PLAY_CARD,
            "drawCardFormDiscard" => ST_NEXT_PLAYER,
            "zombiePass" => ST_NEXT_PLAYER,
        ]
    ],
    ST_PLAYER_PLAY_CARD => [
        "name" => "playCard",
        "description" => clienttranslate('${actplayer} must choose a card to play'),
        "descriptionmyturn" => clienttranslate('${you} must choose a card to play'),
        "type" => "activeplayer",
//        "args" => "argChooseCard",  
        "possibleactions" => [
            "playCard",
            "discardCard"
        ],
        "transitions" => [
            "playCard" => ST_NEXT_PLAYER,
            "zombiePass" => ST_NEXT_PLAYER,
        ]
    ]
];

$gameGameStates = [
    ST_NEXT_PLAYER => [
        "name" => "nextPlayer",
        "description" => "",
        "type" => "game",
        "action" => "stNextPlayer",
        "transitions" => [
            "newTurn" => ST_PLAYER_TAKE_CARD,
        ],
    ],
];

$machinestates = $basicGameStates + $playerActionsGameStates + $gameGameStates;