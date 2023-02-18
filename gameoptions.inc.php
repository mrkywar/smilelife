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
 * gameoptions.inc.php
 *
 * Smile Life game options description
 * 
 * In this file, you can define your game options (= game variants).
 *   
 * Note: If your game has no variant, you don't have to modify this file.
 *
 * Note²: All options defined in this file should have a corresponding "game state labels"
 *        with the same ID (see "initGameStateLabels" in smilelife.game.php)
 *
 * !! It is not a good idea to modify this file when a game is running !!
 *
 */
require_once 'modules/constants.inc.php';

$game_options = [
    OPTION_LENGTH => [
        'name' => totranslate("Game length"),
        'values' => [
            CHOICE_LENGTH_ALL => [
                'name' => totranslate("Normal"),
                'description' => totranslate("Play with the full deck")
            ],
            CHOICE_LENGTH_QUARTER => [
                'name' => totranslate("1/4 deck"),
                'tm_display' => totranslate("1/4 deck"),
                'description' => totranslate("Play with only one quarter of the"
                        . " deck (50 cards)")
            ],
            CHOICE_LENGTH_THIRD => [
                'name' => totranslate("1/3 deck"),
                'tm_display' => totranslate("1/3 deck"),
                'description' => totranslate("Play with only one third of the "
                        . "deck (67 cards)")
            ],
            CHOICE_LENGTH_HALF => [
                'name' => totranslate("1/2 deck"),
                'tm_display' => totranslate("1/2 deck"),
                'description' => totranslate("Play with only one half of the "
                        . "deck (100 cards)")
            ],
            CHOICE_LENGTH_TWO_THIRDS => [
                'name' => totranslate("2/3 deck"),
                'tm_display' => totranslate("2/3 deck"),
                'description' => totranslate("Play with only two thirds of the "
                        . "deck (133 cards)")
            ],
            CHOICE_LENGTH_THREE_QUARTERS => [
                'name' => totranslate("3/4 deck"),
                'tm_display' => totranslate("3/4 deck"),
                'description' => totranslate("Play with only three quarters of "
                        . "the deck (150 cards)")
            ]
        ]
    ]
];
//$game_options = array(
//    OPTION_LENGTH => array(
//            CH_LENGTH_HALF => array(),
//            CH_LENGTH_TWO_THIRDS => array(),
//            CH_LENGTH_THREE_QUARTERS => array(),
//        ),
//        'default' => CH_LENGTH_ALL
//    ),
//);

$game_preferences = array(
    100 => array(
        'name' => totranslate('Card size'),
        'needReload' => true, // after user changes this preference game interface would auto-reload
        'values' => array(
            CH_XS => array('name' => totranslate('XS')),
            CH_S => array('name' => totranslate('S')),
            CH_M => array('name' => totranslate('M')),
            CH_L => array('name' => totranslate('L')),
            CH_XL => array('name' => totranslate('XL')),
        ),
        'default' => CH_S
    ),
    101 => array(
        'name' => totranslate('Card size in tooltip'),
        'needReload' => true, // after user changes this preference game interface would auto-reload
        'values' => array(
            CH_XS => array('name' => totranslate('XS')),
            CH_S => array('name' => totranslate('S')),
            CH_M => array('name' => totranslate('M')),
            CH_L => array('name' => totranslate('L')),
            CH_XL => array('name' => totranslate('XL')),
        ),
        'default' => CH_XL
    )
);
