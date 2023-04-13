define([
    "dojo",
    "dojo/_base/declare",
    "ebg/counter",

    g_gamethemeurl + 'modules/js/Card/Card.js',
    g_gamethemeurl + 'modules/js/Table/PlayerTable.js',
    g_gamethemeurl + 'modules/js/Table/PlayerPanel.js',
    g_gamethemeurl + 'modules/js/Table/TableDraw.js',
    g_gamethemeurl + 'modules/js/UserInteraction/Button.js',
    g_gamethemeurl + 'modules/js/Notification/Notification.js',
], function (dojo, declare) {
    return declare(
            "game.smilelife",
            [
                smilelife.playertable,
                smilelife.playerpanel,
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
            this.animationTimer = 500;


        },

        getGame: function () {
            return this;
        },

        setup: function (gamedatas) {
            this.debug("Setup Begin with this gamedatas : ", gamedatas);

            this.gamedatas = gamedatas;

            this.displayDeckAndDiscard();
            this.displayTables();
            this.displayPanels();

            this.applyCardSize();
        },

        takeAction: function (action, data, reEnterStateOnError, checkAction = true) {
            this.debug('TA', action, data, reEnterStateOnError, checkAction)
            data = data || {};
            if (data.lock === undefined) {
                data.lock = true;
            } else if (data.lock === false) {
                delete data.lock;
            }

            let promise = new Promise((resolve, reject) => {
                this.ajaxcall(
                        '/' + this.game_name + '/' + this.game_name + '/' + action + '.html',
                        data,
                        this,
                        (data) => resolve(data),
                        (isError, message, code) => {
                                this.debug(isError, message, code);
                                if (isError) {
                                    reject(message, code);
                                }
                            },
                        );
            });

            return promise;



//            if (checkAction && !this.checkAction(action))
//                return false;
//
//            
//            let promise = new Promise((resolve, reject) => {
//                this.ajaxcall(
//                        '/' + this.game_name + '/' + this.game_name + '/' + action + '.html',
//                        data,
//                        this,
//                        (data) => resolve(data),
//                        (isError, message, code) => {
//                    if (isError)
//                        reject(message, code);
//                },
//                        );
//            });
//
//            if (reEnterStateOnError) {
//                promise.catch(() => thips.onEnteringState(this.gamedatas.gamestate.name, this.gamedatas.gamestate));
//            }
//
//            return promise;
        }

    });

});
  