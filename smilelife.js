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
    "dojo",
    "dojo/_base/declare",
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
                    
                    this.setupNotifications();

                },

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

                    var _this = this;
//                    dojo.connect(this.notifqueue, 'addToLog', function () {
//                        return _this.addLogClass();
//                    });

                    var notifs = [
                        ['resignNotification', 3000]
                    ]
                    notifs.forEach(function (notif) {
//                        _this.debug(notif[0], "notif_".concat(notif[0]));
                        dojo.subscribe(notif[0], _this, "notif_".concat(notif[0]));
                        _this.notifqueue.setSynchronous(notif[0], notif[1]);
                    });

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

                notif_resignNotification: function (notif) {
                    this.debug("callback called", notif);
                },
//
//                addLogClass: function () {
//                    if (this.lastNotif == null) {
//                        return;
//                    }
//                    var notif = this.lastNotif;
//                    var elem = document.getElementById("log_".concat(notif.logId));
//                    if (elem) {
//                        var type = notif.msg.type;
//                        if (type == 'history_history')
//                            type = notif.msg.args.originalType;
//                        if (notif.msg.args.actionPlayerId) {
//                            elem.dataset.playerId = '' + notif.msg.args.actionPlayerId;
//                        }
//                    }
//                },

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