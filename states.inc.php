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
    ST_GAME_PLAYER_JUMP => [
        "name" => "playerJump",
        "description" => clienttranslate("player Jump"),
        "type" => "manager",
        "action" => "stGamePlayerJump",
        "transitions" => [
            "discard" => ST_PLAYER_RESEARCHER_DISCARD,
            "backToNormal" => ST_PLAYER_TAKE_CARD
        ]
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
        "possibleactions" => [
            "resign",
            "drawCard",
            "vonlontaryDivorce",
            "resignAdultery",
            "playFormDiscard"
        ],
        "transitions" => [
            "resignAndPlay" => ST_PLAYER_TAKE_CARD,
            "resignAndPass" => ST_NEXT_PLAYER,
            "attackAndDiscard" => ST_GAME_PLAYER_JUMP,
            "resignAndDiscard" => ST_PLAYER_RESEARCHER_DISCARD,
            "volontryDivorse" => ST_NEXT_PLAYER,
            "drawCard" => ST_PLAYER_PLAY_CARD,
            "playCard" => ST_NEXT_PLAYER,
            "zombiePass" => ST_NEXT_PLAYER,
            "luckAction" => ST_PLAYER_SPECIAL_LUCK,
            "rainbowAction" => ST_PLAYER_SPECIAL_RAINBOW,
            "birthdayAction" => ST_PLAYER_SPECIAL_BIRTHDAY
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
            "resignAdultery",
            "discardCard",
            "casinoBet"
        ],
        "transitions" => [
            "resignAndPlay" => ST_PLAYER_PLAY_CARD,
            "playAgain" => ST_PLAYER_PLAY_CARD,
            "resignAndDiscard" => ST_GAME_PLAYER_JUMP,
            "playCard" => ST_NEXT_PLAYER,
            "playPass" => ST_NEXT_PLAYER,
            "casinoBet" => ST_NEXT_PLAYER,
            "stopBonus"=>ST_NEXT_PLAYER,
            "zombiePass" => ST_NEXT_PLAYER,
            "luckAction" => ST_PLAYER_SPECIAL_LUCK,
            "rainbowAction" => ST_PLAYER_SPECIAL_RAINBOW,
            "birthdayAction" => ST_PLAYER_SPECIAL_BIRTHDAY
        ]
    ],
    ST_PLAYER_SPECIAL_LUCK => [
        "name" => "luckAction",
        "description" => clienttranslate('${actplayer} play chance and must choose a card to keep'),
        "descriptionmyturn" => clienttranslate('${you} play chance and must choose a card to keep'),
        "type" => "activeplayer",
        "possibleactions" => [
            "luckChoice"
        ],
        "transitions" => [
            "playAgain" => ST_PLAYER_PLAY_CARD
        ]
    ],
    ST_PLAYER_SPECIAL_RAINBOW => [
        "name" => "rainbowAction",
        "description" => clienttranslate('${actplayer} play up to three cards'),
        "descriptionmyturn" => clienttranslate('${you} play up to three cards'),
        "type" => "activeplayer",
        "possibleactions" => [
            "playCard",
            "rainbowStop"
        ],
        "transitions" => [
            "playAgain" => ST_PLAYER_SPECIAL_RAINBOW,
            "stopBonus" => ST_NEXT_PLAYER
        ]
    ],
    ST_PLAYER_RESEARCHER_DISCARD => [
        "name" => "researcherDiscard",
        "description" => clienttranslate('${actplayer} should discard a card'),
        "descriptionmyturn" => clienttranslate('${you} should discard a card'),
        "type" => "activeplayer",
        "possibleactions" => [
            "discardCard"
        ],
        "transitions" => [
            "playPass" => ST_GAME_PLAYER_JUMP
        ]
    ],
    ST_PLAYER_SPECIAL_BIRTHDAY => [
        "name" => "birthdayConsequence",
        "type" => "multipleactiveplayer",
        "description" => clienttranslate('some players should choose a wage to offer'),
        "descriptionmyturn" => clienttranslate('${you} should choose a wage to offer'),
        'action' => 'stBirthdayInit',

        "possibleactions" => [
            "offerWage"
        ],
        "transitions" => [
            "nextPlayer" => ST_NEXT_PLAYER,
        ]
    ]
];

$gameGameStates = [
    ST_NEXT_PLAYER => [
        "name" => "nextPlayer",
        "description" => "",
        "type" => "game",
        "action" => "stNextPlayer",
        "updateGameProgression" => true,
        "transitions" => [
            "newTurn" => ST_PLAYER_TAKE_CARD,
            "playerPass" => ST_NEXT_PLAYER,
            "endGame" => ST_GAME_END,
        ],
    ],
];

$machinestates = $basicGameStates + $playerActionsGameStates + $gameGameStates;
