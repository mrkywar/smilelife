define([
    "dojo",
    "dojo/_base/declare",
], function (dojo, declare) {
    return declare(
            "smilelife.notification.card.casino",
            [],
            {
                notif_betNotification: function (notif)
                {
                    var card = notif.args.card;

                    if (parseInt(notif.args.playerId) === this.player_id) {
                        this.displayCard(card, "pile_casino", "myhand");
                        dojo.query(".selected").removeClass("selected");
                        this.myTable = notif.args.table;
                    } else {
                        this.displayCard(card, "pile_casino", "playerpanel_" + notif.args.playerId, true);
                        this.gamedatas.tables[notif.args.playerId] = notif.args.table;
                    }

                    this.handCounters[notif.args.playerId].setValue(this.handCounters[notif.args.playerId].getValue() - 1);
                    this.casinoCounter.setValue(this.casinoCounter.getValue() + 1);
                },

                notif_casinoResolvedNotification: function (notif) {
                    this.debug(notif.args);
                    var notifCards = notif.args.cards;
                    var index = 0;
                    var _this = this;

                    function processNextCard() {
                        if (index < notifCards.length) {
                            var card = notifCards[index];
                            _this.displayCard(card, "pile_" + card.pile + "_" + notif.args.playerId, "pile_casino");
                            index++;
                            setTimeout(processNextCard, 100);
                        }
                    }

                    processNextCard();
                    
                    this.casinoCounter.setValue(1);
                },
            }
    );
});