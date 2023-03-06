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
/*
  Game state machine is a tool used to facilitate game developpement by doing common stuff that can be set up
  in a very easy way from this configuration file.

  Please check the BGA Studio presentation about game state to understand this, and associated documentation.

  Summary:

  States types:
  _ activeplayer: in this type of state, we expect some action from the active player.
  _ multipleactiveplayer: in this type of state, we expect some action from multiple players (the active players)
  _ game: this is an intermediary state where we don't expect any actions from players. Your game logic must decide what is the next game state.
  _ manager: special type for initial and final state

  Arguments of game states:
  _ name: the name of the GameState, in order you can recognize it on your own code.
  _ description: the description of the current game state is always displayed in the action status bar on
  the top of the game. Most of the time this is useless for game state with "game" type.
  _ descriptionmyturn: the description of the current game state when it's your turn.
  _ type: defines the type of game states (activeplayer / multipleactiveplayer / game / manager)
  _ action: name of the method to call when this game state become the current game state. Usually, the
  action method is prefixed by "st" (ex: "stMyGameStateName").
  _ possibleactions: array that specify possible player actions on this step. It allows you to use "checkAction"
  method on both client side (Javacript: this.checkAction) and server side (PHP: self::checkAction).
  _ transitions: the transitions are the possible paths to go from a game state to another. You must name
  transitions in order to use transition names in "nextState" PHP method, and use IDs to
  specify the next game state for each transition.
  _ args: name of the method to call to retrieve arguments for this gamestate. Arguments are sent to the
  client side to be used on "onEnteringState" or to set arguments in the gamestate description.
  _ updateGameProgression: when specified, the game progression is updated (=> call to your getGameProgression
  method).
 */

//    !! It is not a good idea to modify this file when a game is running !!


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
    ST_END_GAME => [
        "name" => "gameEnd",
        "description" => clienttranslate("End of game"),
        "type" => "manager",
        "action" => "stGameEnd",
        "args" => "argGameEnd",
    ],
];

$playerActionsGameStates = [
    ST_PLAYER_TAKE_CARD => [
        "name" => "takeCards",
        "description" => clienttranslate('${actplayer} must take a cards from deck or discard'),
        "descriptionmyturn" => clienttranslate('${you} must take a cards from deck or discard'),
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

//$machinestates = array(
//
//    // The initial state. Please do not modify.
//    ST_GAME_SETUP => array(
//        "name" => "gameSetup",
//        "description" => "",
//        "type" => "manager",
//        "action" => "stGameSetup",
//        "transitions" => array("" => ST_PLAYER_TURN)
//    ),
//
//    ST_PLAYER_TURN => array(
//    		"name" => "playerTurn",
//    		"description" => clienttranslate('${actplayer} can play a card'),
//    		"descriptionmyturn" => clienttranslate('${you} can play a card'),
//    		"type" => "activeplayer",
//    		"possibleactions" => array("draw", "takeAndPlayDiscard", "quit", "divorce"),
//    		"transitions" => array("drawn" => ST_PLAYER_PLAY, "turnEnd" => ST_TURN_END)
//    ),
//	
//    ST_PLAYER_PLAY => array(
//    		"name" => "playerPlay",
//    		"description" => clienttranslate('${actplayer} must play or discard a card from their hand'),
//    		"descriptionmyturn" => clienttranslate('${you} must play or discard a card from their hand'),
//    		"type" => "activeplayer",
//    		"possibleactions" => array("play", "discard"),
//    		"transitions" => array("turnEnd" => ST_TURN_END)
//    ),
//    
//    ST_TURN_END => array(
//    		"name" => "endTurn",
//    		"description" => clienttranslate('${actplayer} must play a card or pass'),
//    		"descriptionmyturn" => clienttranslate('${you} must play a card or pass'),
//    		"type" => "game",
//    		"transitions" => array("nextPlayer" => ST_PLAYER_TURN, "gameEnd" => ST_GAME_END)
//    ),
//   
//    // Final state.
//    // Please do not modify (and do not overload action/args methods).
//    ST_GAME_END => array(
//        "name" => "gameEnd",
//        "description" => clienttranslate("End of game"),
//        "type" => "manager",
//        "action" => "stGameEnd",
//        "args" => "argGameEnd"
//    )
//);



