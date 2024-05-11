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
                    this.debug("score",notif.args);
                    for (var playerId in notif.args.scores) {
                        var score = notif.args.scores[playerId];
                        this.debug('score for '+playerId, score);
//                        this.displayScoring("player_score_" + playerId, '000000', score.score, 20);
//                        this.scoreCtrl[playerId].toValue(score);
                    }
                },

            }
    );
});