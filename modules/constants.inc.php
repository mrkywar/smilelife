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
define('OP_LENGTH', 100);
define('CH_LENGTH_ALL', 1);
define('CH_LENGTH_QUARTER', 2);
define('CH_LENGTH_THIRD', 3);
define('CH_LENGTH_HALF', 4);
define('CH_LENGTH_TWO_THIRDS', 5);
define('CH_LENGTH_THREE_QUARTERS', 6);

define('OP_MODULES', 101);
define('CH_MODULES_BASE_GAME', 1);

/*
 * Game preferences (gamepreferences.inc.php)
 */
define('PR_CARD_SIZE', 100);
define('PR_TOOLTIP_CARD_SIZE', 101);

define('CH_XS', 1);
define('CH_S', 2);
define('CH_M', 3);
define('CH_L', 4);
define('CH_XL', 5);

/*
 * Game states (states.inc.php)
 */
define('ST_GAME_SETUP', 1);
define('ST_PLAYER_TURN', 2);
define('ST_PLAYER_PLAY', 3);
define('ST_TURN_END', 4);
define('ST_GAME_END', 99);

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
