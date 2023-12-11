define([
    "dojo",
    "dojo/_base/declare",
    "ebg/counter",

    g_gamethemeurl + 'modules/js/Card/Card.js',
    g_gamethemeurl + 'modules/js/Table/PlayerTable.js',
    g_gamethemeurl + 'modules/js/Table/PlayerPanel.js',
    g_gamethemeurl + 'modules/js/Table/TableDraw.js',
    g_gamethemeurl + 'modules/js/Table/AttackModal.js',
    g_gamethemeurl + 'modules/js/Table/Discard.js',
    g_gamethemeurl + 'modules/js/Table/AdditionalCardModal.js',
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
                smilelife.table.attackModal,
                smilelife.table.additionalCardModal,
                smilelife.table.discard,
                smilelife.ui.button,
                smilelife.notification,
            ], {

        constructor: function () {

            this.playerTables = [];
            this.handCounters = [];
            
            this.deckCounter = null;
            this.discardCounter = null;
            this.offsideCounter = null;
            this.casinoCounter = null;

            this.cardDefaultSize = "M"; //TODO : See if I keep this
            this.casino = [];
            this.game = this;
            this.animationTimer = ANNIMATION_TIMER;


        },

        getGame: function () {
            return this;
        },

        setup: function (gamedatas) {
            this.debug("Setup Begin with this gamedatas : ", gamedatas);

            this.gamedatas = gamedatas;

            this.displayDeckAndDiscard();
            this.displayCasinoCards();
            this.displayTables();
            this.displayPanels();

            this.applyCardSize();
        },

        takeAction: function (action, data, reEnterStateOnError, checkAction = true) {
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
  