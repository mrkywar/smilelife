define([
    'dojo',
    'dojo/_base/declare',
], function (dojo, declare) {
    return declare(
            'smilelife.notification.play',
            [
                //smilelife.state.draw
            ],
            {

                notif_playNotification: function (notif) {
                    this.debug("notif_playNotification called", notif);

                    var card = notif.args.card;
                    this.debug("Card",card);

                    if (parseInt(notif.args.playerId) === this.player_id) {
//                        this.displayCard(card, "card_empty", "myhand");
                    } else {
//                        this.displayCard(card, "card_empty", "playerpanel_" + notif.args.playerId, true);
                    }

                    var _this = this;
                    setTimeout(function () {
                        _this.handCounters[notif.args.playerId].setValue(_this.handCounters[notif.args.playerId].getValue() - 1);
                    }, this.animationTimer);
                },
            }
    );
});