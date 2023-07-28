define([
    "dojo",
    "dojo/_base/declare",
], function (dojo, declare) {
    return declare(
            "smilelife.notification.card.jobs",
            [],
            {
                notif_maxCardUpdateNotification: function (notif)
                {
                    this.debug('mcun',notif);
//                    this.maxhandCounters[player.id] = 0;
//                    var card = notif.args.card;
//                    var cardDest = "pile_" + card.pile + "_" + notif.args.playerId;
//                    this.displayCard(card, cardDest, "playerpanel_" + notif.args.playerId);
                }
            }
    );
});