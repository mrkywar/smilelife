define([
    "dojo",
    "dojo/_base/declare",
    "ebg/counter",
    
    g_gamethemeurl + 'modules/js/Card/Card.js',

//    g_gamethemeurl + 'modules/js/Game/DisplayCardTrait.js',
//    g_gamethemeurl + 'modules/js/Game/DisplayTableTrait.js',
//    g_gamethemeurl + 'modules/js/Game/DisplayDrawAndDiscardTrait.js',
//    g_gamethemeurl + 'modules/js/State/StatesManager.js',
//    g_gamethemeurl + 'modules/js/Notification/NotificationManager.js',
], function (dojo, declare) {
    return declare(
            "game.smilelife",
            [
                smilelife.card,
//                smilelife.DisplayCardTrait,
//                smilelife.DisplayTableTrait,
//                smilelife.DisplayDrawAndDiscardTrait,
//                smilelife.StatesManager,
//                smilelife.NotificationManager
            ], {

        constructor: function () {
            this.debug("game.smilelife constructor");

            this.playerTables = [];
            this.handCounters = [];
            this.cardSize = "M"; //TODO : See if I keep this
            this.game = this;

        },

        getGame: function(){
            return this;
        },

        setup: function (gamedatas) {
            this.debug("Setup Begin with this gamedatas : ", gamedatas);

            this.gamedatas = gamedatas;

        }

    });

});
  