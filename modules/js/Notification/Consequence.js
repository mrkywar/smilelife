define([
    'dojo',
    'dojo/_base/declare',
], function (dojo, declare) {
    return declare(
            'smilelife.notification.consequence',
            [
                //smilelife.state.draw
            ],
            {

                notif_doublonFlirtNotification: function (notif) {
                    //this.debug(notif);

                    var card = notif.args.card;
                    var cardDest = "pile_" + card.pile + "_" + notif.args.playerId;
                    var cardFrom = "pile_" + card.pile + "_" + notif.args.targetId;
                    this.displayCard(card, cardDest, cardFrom, true);

                },
            }
    );
});