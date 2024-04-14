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
                },
                doSteelCard: function(notif){
                    var card = notif.args.card;
                    var cardDest = "pile_" + card.pile + "_" + notif.args.playerId;
                    var cardFrom = "pile_" + card.pile + "_" + notif.args.targetId;
                    this.displayCard(card, cardDest, cardFrom, true);
                    
                    this.boardCounter[notif.args.targetId][notif.args.card.pile].setValue(this.boardCounter[notif.args.targetId][notif.args.card.pile].getValue() -1);
                    this.boardCounter[notif.args.playerId][notif.args.card.pile].setValue(this.boardCounter[notif.args.playerId][notif.args.card.pile].getValue() +1);
                }
            }
    );
});