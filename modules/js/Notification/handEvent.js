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
                    var givenCard = notif.args.givenCard;
                    var cardDest = "playerpanel_" + notif.args.playerId;
                    this.displayCard(givenCard, cardDest, "myhand", true);

                    var recivedCard = notif.args.recivedCard
                    var cardFrom = "playerpanel_" + notif.args.opponentId;
                    this.displayCard(recivedCard, "myhand", cardFrom);
                },
                notif_handUpdateNotification: function(notif){
                    this.myHand = notif.args.myHand;
                }
            }
    );
});