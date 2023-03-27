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
                        var card = notif.args.card;
                        this.displayCard(card, "myhand", "pile_deck");
                    } else {
                        var card = {
                            id: Date.now(),
                        };
                        this.displayCard(card, "playerpanel_" + notif.args.playerId, "pile_deck");
                    }
                    
                    var _this = this;
                    setTimeout(function () {
                        _this.deckCounter.setValue(_this.deckCounter.getValue()-1);
                        _this.handCounters[notif.args.playerId].setValue(_this.handCounters[notif.args.playerId].getValue()+1);
                    }, this.animationTimer);
                },
            }
    );
});