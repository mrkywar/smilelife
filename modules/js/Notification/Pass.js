define([
    'dojo',
    'dojo/_base/declare',
], function (dojo, declare) {
    return declare(
            'smilelife.notification.pass',
            [
                //smilelife.state.draw
            ],
            {

                notif_passNotification: function (notif) {
                    var card = notif.args.card;

                    if (parseInt(notif.args.playerId) === this.player_id) {
                        this.displayCard(card, "pile_discard", "myhand");
                        dojo.query(".selected").removeClass("selected");
                        this.myTable = notif.args.table;
                    } else {
                        this.displayCard(card, "pile_discard", "playerpanel_" + notif.args.playerId, true);
                        this.otherTabes[notif.args.playerId] = notif.args.table;
                    }
                    this.discard = notif.args.discard;

                    this.handCounters[notif.args.playerId].setValue(this.handCounters[notif.args.playerId].getValue() - 1);
                    this.discardCounter.setValue(this.discardCounter.getValue() + 1);
                },
            }
    );
});