define([
    "dojo",
    "dojo/_base/declare",
    "ebg/counter",
    
    g_gamethemeurl + 'modules/js/Card/Card.js',
    g_gamethemeurl + 'modules/js/Table/PlayerTable.js',
    g_gamethemeurl + 'modules/js/Table/TableDraw.js',
    g_gamethemeurl + 'modules/js/UserInteraction/Button.js',
    g_gamethemeurl + 'modules/js/Notification/Notification.js',

], function (dojo, declare) {
    return declare(
            "game.smilelife",
            [
                smilelife.playertable,
                smilelife.card,
                smilelife.table.draw,
                smilelife.ui.button,
                smilelife.notification
            ], {

        constructor: function () {

            this.playerTables = [];
            this.handCounters = [];
            this.cardDefaultSize = "M"; //TODO : See if I keep this
            this.game = this;
            

        },

        getGame: function(){
            return this;
        },

        setup: function (gamedatas) {
            this.debug("Setup Begin with this gamedatas : ", gamedatas);

            this.gamedatas = gamedatas;
            
            this.displayDeckAndDiscard();
            this.displayTables();
            
            this.applyCardSize();
        }

    });

});
  