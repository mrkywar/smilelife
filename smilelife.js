define([
    "dojo", "dojo/_base/declare",
    "ebg/core/gamegui",
    "ebg/counter",
    "ebg/stock",

    g_gamethemeurl + 'modules/js/Core/Tools.js',
    g_gamethemeurl + 'modules/js/Game/SmileLife.js',
], function (dojo, declare) {
    return  declare(
            "bgagame.smilelife",
            [
                common.tools,
                game.smilelife
            ]
    )


});






























//
//
//
//
//
//
//
//
//
//
//
//
///////**
// *------
// * BGA framework: © Gregory Isabelli <gisabelli@boardgamearena.com> & Emmanuel Colin <ecolin@boardgamearena.com>
// * SmileLife implementation : © Jean Portemer <jportemer@mailz.org> & Mr_Kywar <mr_kywar@gmail.com>
// *
// * This code has been produced on the BGA studio platform for use on http://boardgamearena.com.
// * See http://en.boardgamearena.com/#!doc/Studio for more information.
// * -----
// *
// * smilelife.js
// *
// * smilelife user interface script
// * 
// * In this file, you are describing the logic of your user interface, in Javascript language.
// *
// */
//
//define([
//    "dojo",
//    "dojo/_base/declare",
//    "ebg/core/gamegui",
//    "ebg/counter",
//
//    g_gamethemeurl + 'modules/js/Core/ToolsTrait.js',
//    g_gamethemeurl + 'modules/js/Game/DisplayCardTrait.js',
//    g_gamethemeurl + 'modules/js/Game/DisplayTableTrait.js',
//    g_gamethemeurl + 'modules/js/Game/DisplayDrawAndDiscardTrait.js',
//    g_gamethemeurl + 'modules/js/State/StatesManager.js',
//    g_gamethemeurl + 'modules/js/Notification/NotificationManager.js',
//], function (dojo, declare) {
//    return declare(
//            "bgagame.smilelife",
//            [
//                common.ToolsTrait,
//                smilelife.DisplayCardTrait,
//                smilelife.DisplayTableTrait,
//                smilelife.DisplayDrawAndDiscardTrait,
//                smilelife.StatesManager,
//                smilelife.NotificationManager
//            ],
//            {
//                constructor: function () {
////                    this.debug('smilelife constructor');
//
//                },
//
//                /*
//                 setup:
//                 
//                 This method must set up the game user interface according to current game situation specified
//                 in parameters.
//                 
//                 The method is called each time the game interface is displayed to a player, ie:
//                 _ when the game starts
//                 _ when a player refreshes the game page (F5)
//                 
//                 "gamedatas" argument contains all datas retrieved by your "getAllDatas" PHP method.
//                 */
//
//                setup: function (gamedatas) {
////                    this.debug("Setup", gamedatas);
//
//                    this.displayTables(gamedatas);
//                    this.displayCards(gamedatas);
//                    this.displayDeckAndDiscard(gamedatas);
//                    
//                },
//
////
////                addLogClass: function () {
////                    if (this.lastNotif == null) {
////                        return;
////                    }
////                    var notif = this.lastNotif;
////                    var elem = document.getElementById("log_".concat(notif.logId));
////                    if (elem) {
////                        var type = notif.msg.type;
////                        if (type == 'history_history')
////                            type = notif.msg.args.originalType;
////                        if (notif.msg.args.actionPlayerId) {
////                            elem.dataset.playerId = '' + notif.msg.args.actionPlayerId;
////                        }
////                    }
////                },
//
//                // TODO: from this point and below, you can write your game notifications handling methods
//
//                /*
//                 Example:
//                 
//                 notif_cardPlayed: function( notif )
//                 {
//                 this.debug( 'notif_cardPlayed' );
//                 this.debug( notif );
//                 
//                 // Note: notif.args contains the arguments specified during you "notifyAllPlayers" / "notifyPlayer" PHP call
//                 
//                 // TODO: play the card in the user interface.
//                 },    
//                 
//                 */
//            });
//});