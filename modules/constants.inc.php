<?php

/* -------------------------------------------------------------------------
 *                  BEGIN - GAME OPTION - LENGTH
 * ---------------------------------------------------------------------- */
define('OPTION_LENGTH', 100);
define('CHOICE_LENGTH_ALL', 1001);
define('CHOICE_LENGTH_HALF', 1002);
define('CHOICE_LENGTH_THREE_QUARTERS', 1003);
define('CHOICE_LENGTH_TWO_THIRDS', 1004);
define('CHOICE_LENGTH_QUARTER', 1005);
define('CHOICE_LENGTH_THIRD', 1006);
/* -------------------------------------------------------------------------
 *                  BEGIN - GAME PREFERENCE - CARD & TOOLTIPS SIZE
 * ---------------------------------------------------------------------- */
define('PREF_CARD_SIZE', 500);
define('PREF_TOOLTIP_SIZE', 501);
define('PREF_CHOICE_SIZE_XS', 5001);
define('PREF_CHOICE_SIZE_S', 5002);
define('PREF_CHOICE_SIZE_M', 5003);
define('PREF_CHOICE_SIZE_L', 5004);
define('PREF_CHOICE_SIZE_XL', 5005);

/* -------------------------------------------------------------------------
 *                  BEGIN - DEPRECATED
 * ---------------------------------------------------------------------- */
/*
 * Game modules
 */
define('BASE_GAME', 0);
define('EXPANSION_TRASH', 1);
define('EXPANSION_GIRL_POWER', 2);

/*
 * Game options (gameoptions.inc.php)
 */

define('OP_MODULES', 101);
define('CH_MODULES_BASE_GAME', 1);
/*
 * Game states (states.inc.php)
 */
define('ST_GAME_SETUP', 1);
define('ST_GAME_END', 99);
define('ST_GAME_PLAYER_JUMP',84); // 84 = 42*2 (linked to 42 action)

define('ST_NEW_ROUND', 10);
define('ST_END_ROUND', 11);

define('ST_NEXT_PLAYER', 20);
define('ST_GAME_SCORE', 21);

define('ST_PLAYER_TAKE_CARD', 30);
define('ST_PLAYER_PLAY_CARD', 31);

define('ST_PLAYER_SPECIAL_LUCK',40);
define('ST_PLAYER_SPECIAL_RAINBOW',41);
define('ST_PLAYER_SPECIAL_CASINO',42);
define('ST_PLAYER_SPECIAL_BIRTHDAY',43);

define('ST_PLAYER_RESEARCHER_DISCARD',50);





//define('ST_GAME_SETUP', 1);
//define('ST_PLAYER_DRAW', 2);
//define('ST_PLAYER_TURN', 3);
//define('ST_NEXT_PLAYER', 20);
////define('ST_PLAYER_DISMISS',4);
//define('ST_TURN_END', 40);
//define('ST_GAME_END', 99);

/*
 * Base reference for card size in px
 */
define("REF_CARD_WIDTH", 160);
define("REF_CARD_HEIGHT", 240);

/*
 * Font families
 */
define('FF_0', "Din condensed");
define('FF_1', "KG Primaric");
define('FF_2', "Adobe source sans");
define('FF_3', "Raleway");
define('FF_4', "Lobster");
define('FF_5', "adobe garamond");
define('FF_6', "Din condensed");
