define([
    "dojo",
    "dojo/_base/declare",
], function (dojo, declare) {
    return declare(
            "smilelife.notification.hand.events",
            [],
            {
                notif_handChangedNotification: function (notif) {
                    this.myHand = notif.args.cards;
                    this.displayMyHand();
                },

                notif_trocNotification: function (notif) {
                    this.debug("HE-TN", notif.args);

                    var givenCard = notif.args.givenCard;
                    var cardFrom = "pile_" + givenCard.pile + "_" + notif.args.opponentId;
                    this.displayCard(givenCard, "playerpanel_" + notif.args.playerId, cardFrom, true);
                    
                }
            }
    );
});