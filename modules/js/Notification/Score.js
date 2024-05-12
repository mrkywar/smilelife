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

                notif_gameResults: function (notif) {
                    for (var playerId in notif.args.scores) {
                        var score = notif.args.scores[playerId];
                        this.displayScoring("player_score_" + playerId, '000000', score.score, ANNIMATION_TIMER);
                        this.scoreCtrl[playerId].toValue(score.score);
                    }
                },

            }
    );
});