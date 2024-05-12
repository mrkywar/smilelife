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

                notif_drawNotification: function (notif) {
                    if (parseInt(notif.args.playerId) === this.player_id) {
                        if (typeof notif.args.card === 'undefined') {
                            var notifCards = notif.args.cards;
                            var index = 0;
                            var _this = this;

                            function processNextCard() {
                                if (index < notifCards.length) {
                                    var card = notifCards[index];
                                    _this.drawDisplayCard(card);
                                    index++;
                                    setTimeout(processNextCard, 100);
                                }
                            }

                            processNextCard();
                        } else {
                            var card = notif.args.card;
                            this.drawDisplayCard(card);
                        }
                    } else {
                        var card = {
                            id: Date.now(),
                        };
                        this.displayCard(card, "playerpanel_" + notif.args.playerId, "pile_deck");
                    }
                    this.debug('draw', notif.args);
                    this.deckCounter.setValue(notif.args.deck);
                    if (0 <= notif.args.deck) {
                        dojo.destroy('card_deck');
                    }
                    this.handCounters[notif.args.playerId].setValue(this.handCounters[notif.args.playerId].getValue() + 1);
                },

                drawDisplayCard: function (card) {
                    this.displayCard(card, "myhand", "pile_deck");
                }



            }
    );
});