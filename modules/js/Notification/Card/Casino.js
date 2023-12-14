define([
    "dojo",
    "dojo/_base/declare",
], function (dojo, declare) {
    return declare(
            "smilelife.notification.card.casino",
            [],
            {
                notif_betNotification: function (notif)
                {
                    var card = notif.args.card;

                    if (parseInt(notif.args.playerId) === this.player_id) {
                        this.displayCard(card, "pile_casino", "myhand");
                        dojo.query(".selected").removeClass("selected");
                        this.myTable = notif.args.table;
                    } else {
                        this.displayCard(card, "pile_casino", "playerpanel_" + notif.args.playerId, true);
                        this.gamedatas.tables[notif.args.playerId] = notif.args.table;
                    }

                    //-- Casino redisplay (to keep on the top)

                    if (null !== this.casino) {
                        var cardCasino = this.casino[0];
                        this.displayCard(cardCasino, "pile_casino", "pile_casino");
                    }

                    this.handCounters[notif.args.playerId].setValue(this.handCounters[notif.args.playerId].getValue() - 1);
                    this.casinoCounter.setValue(this.casinoCounter.getValue() + 1);
                },

                notif_openCasinoNotification: function (notif) {
//                    var card = notif.args.casino;
//                    this.debug('OPEN', notif.args, notif.args.card);
                    if (null === this.casino) {
                        this.casino = [notif.args.casino];
                    } else {
                        this.casino[0] = notif.args.casino
                    }
                    if (typeof notif.args.card !== 'undefined') {
                        this.notif_betNotification(notif);
                    }
                    this.displayCard(notif.args.casino, "pile_casino", "pile_casino");

                    this.handCounters[notif.args.playerId].setValue(this.handCounters[notif.args.playerId].getValue() - 1);
                    this.casinoCounter.setValue(this.casinoCounter.getValue() + 1);
                },

                notif_noOtherBetNotification: function (notif) {
                    var card = notif.args.card;
                    this.displayCard(card, "pile_" + card.pile + "_" + notif.args.playerId, "pile_casino");
                    this.casinoCounter.setValue(1);
                    this.boardCounter[notif.args.playerId][card.pile].setValue(this.boardCounter[notif.args.playerId][card.pile].getValue() + 1);
                    this.gamedatas.tables[notif.args.playerId] = notif.args.table;
                },

                notif_casinoResolvedNotification: function (notif) {
//                    this.debug(notif.args);
                    this.notif_wageLevelUpdate(notif);

                    var card = notif.args.card;
                    var wage = notif.args.wage;

                    this.displayCard(card, "pile_" + card.pile + "_" + notif.args.playerId, "pile_casino");
                    setTimeout(function () {
                        this.displayCard(wage, "pile_" + wage.pile + "_" + notif.args.playerId, "pile_casino");
                    }.bind(this), 100);

                    this.boardCounter[notif.args.playerId][card.pile].setValue(this.boardCounter[notif.args.playerId][card.pile].getValue() + 2);
                    this.casinoCounter.setValue(1);
                    this.gamedatas.tables[notif.args.playerId] = notif.args.table;

                },
            }
    );
});