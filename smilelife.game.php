<?php

use Core\Event\EventDispatcher\EventDispatcher;
use Core\Logger\Logger;
use Core\Managers\PlayerManager;
use Core\Notification\Notification;
use Core\Requester\Requester;
use Core\Requester\Response\Response;
use SmileLife\Card\CardManager;
use SmileLife\Game\DataRetriver\DataRetriver;
use SmileLife\Game\GameProgressionRetriver;
use SmileLife\Game\Initializer\GameInitializer;
use SmileLife\Game\SmileLifeRequester;
use SmileLife\Game\Traits\NextPlayerTrait;
use SmileLife\Game\Traits\PlayersScoresTrait;
use SmileLife\Game\Traits\ZombieTrait;
use SmileLife\PlayerAction\CardRequiermentTrait;
use SmileLife\PlayerAction\DrawTrait;
use SmileLife\PlayerAction\PassTrait;
use SmileLife\PlayerAction\PlayCardTrait;
use SmileLife\PlayerAction\PlayFromDiscardTrait;
use SmileLife\PlayerAction\ResignAdulteryTrait;
use SmileLife\PlayerAction\ResignTrait;
use SmileLife\PlayerAction\VolontaryDivorceTrait;
use SmileLife\PlayerAttributes\PlayerAttributesManager;
use SmileLife\Table\PlayerTableManager;

/**
 * ------
 * BGA framework: © Gregory Isabelli <gisabelli@boardgamearena.com> & Emmanuel Colin <ecolin@boardgamearena.com>
 * SmileLife implementation : © Jean Portemer <jportemer@mailz.org> & Mr_Kywar <mr_kywar@gmail.com>
 * 
 * This code has been produced on the BGA studio platform for use on http://boardgamearena.com.
 * See http://en.boardgamearena.com/#!doc/Studio for more information.
 * -----
 * 
 * smilelife.game.php
 *
 * This is the main file for your game logic.
 *
 * In this PHP file, you are going to defines the rules of the game.
 *
 */
$swdNamespaceAutoload = function ($class) {
    $classParts = explode('\\', $class);

    $firstPart = array_shift($classParts);

    if ($firstPart == 'SmileLife') {

        //var_dump(dirname(__FILE__) . '/modules/php/' . implode(DIRECTORY_SEPARATOR, $classParts) . '.php');die;
        $file = dirname(__FILE__) . '/modules/php/Game/' . implode(DIRECTORY_SEPARATOR, $classParts) . '.php';
        if (file_exists($file)) {
            require_once $file;
        } else {
            var_dump("Impossible to load SmileLife class : $class as $file");
        }
    } elseif ($firstPart == 'Core') {

        //var_dump(dirname(__FILE__) . '/modules/php/Core/' . implode(DIRECTORY_SEPARATOR, $classParts) . '.php');die;
        $file = dirname(__FILE__) . '/modules/php/Core/' . implode(DIRECTORY_SEPARATOR, $classParts) . '.php';
        if (file_exists($file)) {
            require_once $file;
        } else {
            var_dump("Impossible to load Core class : $class");
        }
    }
};
spl_autoload_register($swdNamespaceAutoload, true, true);

require_once( APP_GAMEMODULE_PATH . 'module/table/table.game.php' );
require_once('modules/constants.inc.php');

class SmileLife extends Table {

    /**
     * 
     * @var SmileLife
     */
    private static $instance;

    /**
     * 
     * @var GameInitializer
     */
    private $gameInitializer;

    /**
     * 
     * @var ProgressionRetriver
     */
    private $progressionRetriver;

    /**
     * 
     * @var DateRetriver
     */
    private $dataRetriver;

    /**
     * 
     * @var PlayerTableManager
     */
    private $tableManager;

    /**
     * 
     * @var CardManager
     */
    private $cardManager;

    /**
     * 
     * @var PlayerManager
     */
    private $playerManager;
    
    
    /**
     * 
     * @var PlayerAttributesManager
     */
    private $playerAttributesManager;

    /**
     * EventDispatcher
     */
    private $eventDispatcher;

    /**
     * 
     * @var Requester
     */
    private $requester;

    function __construct() {
        parent::__construct();

        self::$instance = $this;

//        $this->gameInitializer = new GameInitializer();
        $this->gameInitializer = new \SmileLife\Game\Initializer\Test\RevengeFromDiscardTestInitializer();
        $this->progressionRetriver = new GameProgressionRetriver();
        $this->dataRetriver = new DataRetriver();

        $this->tableManager = $this->dataRetriver->getPlayerTableManager();
        $this->cardManager = $this->dataRetriver->getCardManager();
        $this->playerManager = $this->dataRetriver->getPlayerManager();
        $this->playerAttributesManager = new PlayerAttributesManager();

        $this->eventDispatcher = new EventDispatcher();
        $this->requester = new SmileLifeRequester();

        self::initGameStateLabels(array(
                //    "my_first_global_variable" => 10,
                //    "my_second_global_variable" => 11,
                //      ...
                //    "my_first_game_variant" => 100,
                //    "my_second_game_variant" => 101,
                //      ...
        ));
    }

    protected function getGameName() {
        // Used for translations and stuff. Please do not modify.
        return "smilelife";
    }

    /*
      setupNewGame:

      This method is called only once, when a new game is launched.
      In this method, you must setup the game according to the game rules, so that
      the game is ready to be played.
     */

    protected function setupNewGame($players, $options = array()) {
        $firstPlayer = $this->gameInitializer->init($players, $options);

        $this->gamestate->changeActivePlayer($firstPlayer);

        Logger::log("Player", "First Player " . $firstPlayer);

        /*         * ********** End of the game initialization **** */
    }

    /*
      getAllDatas:

      Gather all informations about current game situation (visible by the current player).

      The method is called each time the game interface is displayed to a player, ie:
      _ when the game starts
      _ when a player refreshes the game page (F5)
     */

    protected function getAllDatas() {
        // !! We must only return informations visible by this player !!
        $result = $this->dataRetriver->retrive(self::getCurrentPlayerId());

        return $result;
    }

    /*
      getGameProgression:

      Compute and return the current game progression.
      The number returned must be an integer beween 0 (=the game just started) and
      100 (= the game is finished or almost finished).

      This method is called each time we are in a game state with the "updateGameProgression" property set to true
      (see states.inc.php)
     */

    function getGameProgression() {
        return $this->progressionRetriver->retrive();
    }

//////////////////////////////////////////////////////////////////////////////
//////////// Player actions
//////////// 

    protected function applyResponse(Response $response = null) {
        if (null === $response) {
            return;
        }

        foreach ($response->getNotifications() as $notification) {
            $this->sendNotification($notification);
        }
//        $notification = $this->retriveNotification($response);
//        self::notifyAllPlayers($notification->getType(), $notification->getText(), $notification->getParams());

        $this->gamestate->nextState($response->get('nextState'));
    }

    protected function sendNotification(Notification $notification) {
        if ($notification->isPublic()) {
            self::notifyAllPlayers($notification->getType(), $notification->getText(), $notification->getParams());
        } else {
            self::notifyPlayer($notification->getTargetedPlayer()->getId(), $notification->getType(), $notification->getText(), $notification->getParams());
        }
    }

//-- Traits for Initial Player choices (Resign, Draw) 
    use ResignTrait;
    use PlayFromDiscardTrait;
    use DrawTrait;
    use VolontaryDivorceTrait;
    use ResignAdulteryTrait;

//-- Traits for Player action (Play, Pass) 
    use PlayCardTrait;
    use PassTrait;
    use CardRequiermentTrait;

//////////////////////////////////////////////////////////////////////////////
//////////// Game state arguments
////////////



    /*

      Example for game state "MyGameState":

      function argMyGameState()
      {
      // Get some values from the current game situation in database...

      // return values:
      return array(
      'variable1' => $value1,
      'variable2' => $value2,
      ...
      );
      }
     */

//////////////////////////////////////////////////////////////////////////////
//////////// Game state actions
////////////
    use NextPlayerTrait;
    use PlayersScoresTrait;
    /*
      Here, you can create methods defined as "game state actions" (see "action" property in states.inc.php).
      The action method of state X is called everytime the current game state is set to X.
     */

    /*

      Example for game state "MyGameState":

      function stMyGameState()
      {
      // Do some stuff ...

      // (very often) go to another gamestate
      $this->gamestate->nextState( 'some_gamestate_transition' );
      }
     */

//////////////////////////////////////////////////////////////////////////////
//////////// Zombie
////////////

    use ZombieTrait;

///////////////////////////////////////////////////////////////////////////////////:
////////// DB upgrade
//////////

    /*
      upgradeTableDb:

      You don't have to care about this until your game has been published on BGA.
      Once your game is on BGA, this method is called everytime the system detects a game running with your old
      Database scheme.
      In this case, if you change your Database scheme, you just have to apply the needed changes in order to
      update the game database and allow the game to continue to run with your new version.

     */

    function upgradeTableDb($from_version) {
        // $from_version is the current version of this game database, in numerical form.
        // For example, if the game was running with a release of your game named "140430-1345",
        // $from_version is equal to 1404301345
        // Example:
//        if( $from_version <= 1404301345 )
//        {
//            // ! important ! Use DBPREFIX_<table_name> for all tables
//
//            $sql = "ALTER TABLE DBPREFIX_xxxxxxx ....";
//            self::applyDbUpgradeToAllDB( $sql );
//        }
//        if( $from_version <= 1405061421 )
//        {
//            // ! important ! Use DBPREFIX_<table_name> for all tables
//
//            $sql = "CREATE TABLE DBPREFIX_xxxxxxx ....";
//            self::applyDbUpgradeToAllDB( $sql );
//        }
//        // Please add your future database scheme changes here
//
//
    }

    public static function getInstance(): SmileLife {
        return self::$instance;
    }

}
