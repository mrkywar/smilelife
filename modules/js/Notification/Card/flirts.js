define([
    "dojo",
    "dojo/_base/declare",
], function (dojo, declare) {
    return declare(
            "smilelife.notification.card.flirts",
            [],
            {
                notif_usedFlirtNotification: function (notif)
                {
                    var card = notif.args.card;
                    var cardDest = "pile_" + card.pile + "_" + notif.args.playerId;
                    this.displayCard(card, cardDest, "playerpanel_" + notif.args.playerId);
                },
                
                notif_doublonFlirtNotification: function (notif) {
                    var card = notif.args.card;
                    var cardDest = "pile_" + card.pile + "_" + notif.args.playerId;
                    var cardFrom = "pile_" + card.pile + "_" + notif.args.targetId;
                    this.displayCard(card, cardDest, cardFrom, true);
                    
                    this.boardCounter[notif.args.targetId][notif.args.card.pile].setValue(this.boardCounter[notif.args.targetId][notif.args.card.pile].getValue() -1);
                    this.boardCounter[notif.args.playerId][notif.args.card.pile].setValue(this.boardCounter[notif.args.playerId][notif.args.card.pile].getValue() +1);
                },
                
            }
    );
});