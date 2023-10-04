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
                    this.debug("NOT-Score--nsn",notif);
//                    this.scoreCtrl[playerId].toValue(notif.args.score);
                },

            }
    );
});