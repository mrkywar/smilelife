define([
    "dojo",
    "dojo/_base/declare",
    "ebg/counter",
    
    g_gamethemeurl + 'modules/js/Card/Card.js',
    g_gamethemeurl + 'modules/js/Table/Table.js',

], function (dojo, declare) {
    return declare(
            "game.smilelife",
            [
                smilelife.table,
                smilelife.card,
            ], {

        constructor: function () {
            this.debug("game.smilelife constructor");

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
            
            this.displayTables();
            
            this.applyCardSize();
            
            this.debug("end Setup try to get myTable", this.myTable);

        }

    });

});
  