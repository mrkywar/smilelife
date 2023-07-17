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
                notif_turnpassNotification: function (notif) {
                    this.debug(notif.args);
                    var card = notif.args.card;

                    var cardDest = "pile_" + card.pile + "_" + notif.args.playerId;
                    this.displayCard(card, cardDest, cardDest);
                },

                notif_playNotification: function (notif) {
                    var card = notif.args.card;

                    var cardDest = "pile_" + card.pile + "_" + notif.args.playerId;

                    if (parseInt(notif.args.playerId) === this.player_id) {
                        this.displayCard(card, cardDest, "myhand");
                        dojo.query(".selected").removeClass("selected");
                    } else {
                        this.displayCard(card, cardDest, "playerpanel_" + notif.args.playerId, true);
                    }

                    if (notif.args.fromHand) {
                        this.handCounters[notif.args.playerId].setValue(this.handCounters[notif.args.playerId].getValue() - 1);
                    } else {
                        this.discardCounter.setValue(this.discardCounter.getValue() - 1);
                    }

                    this.boardCounter[notif.args.playerId][notif.args.card.pile].setValue(this.boardCounter[notif.args.playerId][notif.args.card.pile].getValue() + 1);

                    this.discard = notif.args.discard;

                },
            }
    );
});