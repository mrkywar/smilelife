/**
 *------
 * BGA framework: © Gregory Isabelli <gisabelli@boardgamearena.com> & Emmanuel Colin <ecolin@boardgamearena.com>
 * smilelife implementation : © <Your name here> <Your email address here>
 *
 * This code has been produced on the BGA studio platform for use on http://boardgamearena.com.
 * See http://en.boardgamearena.com/#!doc/Studio for more information.
 * -----
 *
 * smilelife.js
 *
 * smilelife user interface script
 * 
 * In this file, you are describing the logic of your user interface, in Javascript language.
 *
 */

define([
    "dojo", "dojo/_base/declare",
    "ebg/core/gamegui",
    "ebg/counter",

    g_gamethemeurl + 'modules/js/Core/ToolsTrait.js',
    g_gamethemeurl + 'modules/js/Game/DisplayCardTrait.js',
    g_gamethemeurl + 'modules/js/Game/DisplayTableTrait.js',
    g_gamethemeurl + 'modules/js/Game/DisplayDrawAndDiscardTrait.js',
    g_gamethemeurl + 'modules/js/State/StatesManager.js',
], function (dojo, declare) {
    return declare(
            "bgagame.smilelife",
            [
                common.ToolsTrait,
                smilelife.DisplayCardTrait,
                smilelife.DisplayTableTrait,
                smilelife.DisplayDrawAndDiscardTrait,
                smilelife.StatesManager,
            ],
            {
                constructor: function () {
//                    this.debug('smilelife constructor');

                },

                /*
                 setup:
                 
                 This method must set up the game user interface according to current game situation specified
                 in parameters.
                 
                 The method is called each time the game interface is displayed to a player, ie:
                 _ when the game starts
                 _ when a player refreshes the game page (F5)
                 
                 "gamedatas" argument contains all datas retrieved by your "getAllDatas" PHP method.
                 */

                setup: function (gamedatas) {
//                    this.debug("Setup", gamedatas);

                    this.displayTables(gamedatas);
                    this.displayCards(gamedatas);
                    this.displayDeckAndDiscard(gamedatas);


                    //this.setupCard(gamedatas);
                    //this.displayTable(gamedatas);

                },

                ///////////////////////////////////////////////////
                //// Utility methods

                /*
                 
                 Here, you can defines some utility methods that you can use everywhere in your javascript
                 script.
                 
                 */


                ///////////////////////////////////////////////////
                //// Player's action

                /*
                 
                 Here, you are defining methods to handle player's action (ex: results of mouse click on 
                 game objects).
                 
                 Most of the time, these methods:
                 _ check the action is possible at this game state.
                 _ make a call to the game server
                 
                 */

                /* Example:
                 
                 onMyMethodToCall1: function( evt )
                 {
                 this.debug( 'onMyMethodToCall1' );
                 
                 // Preventing default browser reaction
                 dojo.stopEvent( evt );
                 
                 // Check that this action is possible (see "possibleactions" in states.inc.php)
                 if( ! this.checkAction( 'myAction' ) )
                 {   return; }
                 
                 this.ajaxcall( "/smilelife/smilelife/myAction.html", { 
                 lock: true, 
                 myArgument1: arg1, 
                 myArgument2: arg2,
                 ...
                 }, 
                 this, function( result ) {
                 
                 // What to do after the server call if it succeeded
                 // (most of the time: nothing)
                 
                 }, function( is_error) {
                 
                 // What to do after the server call in anyway (success or failure)
                 // (most of the time: nothing)
                 
                 } );        
                 },        
                 
                 */


                ///////////////////////////////////////////////////
                //// Reaction to cometD notifications

                /*
                 setupNotifications:
                 
                 In this method, you associate each of your game notifications with your local method to handle it.
                 
                 Note: game notification names correspond to "notifyAllPlayers" and "notifyPlayer" calls in
                 your smilelife.game.php file.
                 
                 */
                setupNotifications: function ()
                {
                    this.debug('notifications subscriptions setup');

                    // TODO: here, associate your game notifications with local methods

                    // Example 1: standard notification handling
                    // dojo.subscribe( 'cardPlayed', this, "notif_cardPlayed" );

                    // Example 2: standard notification handling + tell the user interface to wait
                    //            during 3 seconds after calling the method in order to let the players
                    //            see what is happening in the game.
                    // dojo.subscribe( 'cardPlayed', this, "notif_cardPlayed" );
                    // this.notifqueue.setSynchronous( 'cardPlayed', 3000 );
                    // 
                },

                // TODO: from this point and below, you can write your game notifications handling methods

                /*
                 Example:
                 
                 notif_cardPlayed: function( notif )
                 {
                 this.debug( 'notif_cardPlayed' );
                 this.debug( notif );
                 
                 // Note: notif.args contains the arguments specified during you "notifyAllPlayers" / "notifyPlayer" PHP call
                 
                 // TODO: play the card in the user interface.
                 },    
                 
                 */
            });
});
