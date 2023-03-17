define([
    'dojo',
    'dojo/_base/declare',
], function (dojo, declare) {
    return declare(
            'smilelife.notification.draw',
            [
                //smilelife.state.draw
            ],
            {
                notif_resignNotification: function (notif) {
                    this.debug("notif_resignNotification called", notif);
                },

                notif_drawNotification: function (notif) {
//                    this.debug("drawcallback called", notif);
//                    var cardId = Date.now().toString();
                    if (parseInt(notif.args.playerId) === this.player_id) {
                        var card = notif.args.card;
                        this.displayCard(card, "myhand", "card_deck");

                   
                    } else {
                        this.debug("Not Implemented Yet");
                    }
                },
            }
    );
});