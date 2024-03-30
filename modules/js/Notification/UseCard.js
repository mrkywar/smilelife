define([
    'dojo',
    'dojo/_base/declare',
], function (dojo, declare) {
    return declare(
            'smilelife.notification.useCard',
            [
                //smilelife.state.draw
            ],
            {

                notif_usedCardNotification: function (notif)
                {
                    var card = notif.args.card;
                    var cardDest = "pile_" + card.pile + "_" + notif.args.playerId;
                    this.displayCard(card, cardDest, "playerpanel_" + notif.args.playerId);
                },

            }
    );
});