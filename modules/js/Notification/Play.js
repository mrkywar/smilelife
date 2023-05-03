define([
    'dojo',
    'dojo/_base/declare',
], function (dojo, declare) {
    return declare(
            'smilelife.notification.play',
            [
                //smilelife.state.draw
            ],
            {

                notif_playNotification: function (notif) {
                    this.debug("notif_playNotification called", notif);

                    var card = notif.args.card;
                    this.debug("Card", card);

                    var cardDest = "pile_" + card.pile + "_" + notif.args.playerId;

                    if (parseInt(notif.args.playerId) === this.player_id) {
                        this.displayCard(card, cardDest, "myhand", true);
                        dojo.query(".selected").removeClass("selected");
                    } else {
                        this.displayCard(card, cardDest, "playerpanel_" + notif.args.playerId);
                    }

                    if (notif.args.fromHand) {
                        this.handCounters[notif.args.playerId].setValue(this.handCounters[notif.args.playerId].getValue() - 1);
                    } else {
                        this.discardCounter.setValue(this.discardCounter.getValue() - 1);
                    }
                    this.discard = notif.args.discard;

                },
            }
    );
});