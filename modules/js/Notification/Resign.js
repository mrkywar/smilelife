define([
    'dojo',
    'dojo/_base/declare',
], function (dojo, declare) {
    return declare(
            'smilelife.notification.resign',
            [
                //smilelife.state.draw
            ],
            {
                notif_resignNotification: function (notif) {
                    this.notif_discardNotification(notif);
                },

                notif_discardNotification: function (notif) {
                    var card = notif.args.card;
                    this.displayCard(card, "pile_discard", "pile_" + card.pile + "_" + notif.args.playerId);

                    if (parseInt(notif.args.playerId) === this.player_id) {
                        this.myTable = notif.args.table;
                    } else {
                        this.gamedatas.tables[notif.args.playerId] = notif.args.table;
                    }

                    this.discardCounter.setValue(this.discardCounter.getValue() + 1);
                    this.boardCounter[notif.args.playerId][notif.args.card.pile].setValue(this.boardCounter[notif.args.playerId][notif.args.card.pile].getValue() - 1);
                },

                notif_offsideNotification: function (notif) {
                    for (var cardIndex in notif.args.cards) {
                        var card = notif.args.cards[cardIndex];
                        this.displayCard(card, "pile_offside", "pile_" + card.pile + "_" + notif.args.playerId);
                        this.offsideCounter.setValue(this.offsideCounter.getValue() + 1);
                        this.boardCounter[notif.args.playerId][card.pile].setValue(this.boardCounter[notif.args.playerId][card.pile].getValue() - 1);
                    }
                }
            }
    );
});