define([
    'dojo',
    'dojo/_base/declare',
], function (dojo, declare) {
    return declare(
            'smilelife.notification.score',
            [
                //smilelife.state.draw
            ],
            {

                notif_scoreNotification: function (notif) {
                    this.displayScoring("player_score_" + notif.args.playerId, '000000', notif.args.score, 200);
                    this.scoreCtrl[this.player_id].setValue(notif.args.score);
//                    this.scoreCtrl[playerId].toValue(notif.args.score);
                },

            }
    );
});