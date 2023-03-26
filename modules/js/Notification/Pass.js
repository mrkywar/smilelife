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
                    
                    var card = notif.args.card;

                    this.displayCard(card, "card_discard", "myhand");
                    
                    var _this = this;
                    setTimeout(function () {
                        _this.handCounters[notif.args.playerId].setValue(_this.handCounters[notif.args.playerId].getValue()-1);
                        _this.discardCounter.setValue(_this.discardCounter.getValue()+1);
                    }, this.animationTimer);
                },
            }
    );
});