define([
    'dojo',
    'dojo/_base/declare',
], function (dojo, declare) {
    return declare(
            'smilelife.notification.pass',
            [
                //smilelife.state.draw
            ],
            {

                notif_passNotification: function (notif) {
                    this.debug("notif_passNotification called", notif);
                    
                    
//                    if (parseInt(notif.args.playerId) === this.player_id) {
//                        var card = notif.args.card;
//                        this.displayCard(card, "myhand", "card_deck");
//                    } else {
//                        var card = {
//                            id: Date.now(),
//                        };
//                        this.displayCard(card, "playerpanel_" + notif.args.playerId, "card_deck");
//                    }
//                    
//                    var _this = this;
//                    setTimeout(function () {
//                        _this.deckCounter.setValue(_this.deckCounter.getValue()-1);
//                        _this.handCounters[notif.args.playerId].setValue(_this.handCounters[notif.args.playerId].getValue()+1);
//                    }, this.animationTimer);
                },
            }
    );
});