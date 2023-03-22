define([
    'dojo',
    'dojo/_base/declare',
], function (dojo, declare) {
    return declare(
            'smilelife.notification.resign',
            [
                //smilelife.state.draw
            ],
            {
                notif_resignNotification: function (notif) {
                    this.debug("notif_resignNotification called ???", notif);

                    var card = notif.args.card;
                    this.displayCard(card, "pile_discard", "pile_job_" + notif.args.playerId, );
                },
            }
    );
});