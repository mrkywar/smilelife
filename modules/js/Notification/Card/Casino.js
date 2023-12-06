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

                    this.handCounters[notif.args.playerId].setValue(this.handCounters[notif.args.playerId].getValue() - 1);
                    this.casinoCounter.setValue(this.casinoCounter.getValue() + 1);
                },

                notif_casinoResolvedNotification: function (notif) {
                    this.debug(notif.args);

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