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
                    this.debug("notif_resignNotification called", notif);

                    var card = notif.args.card;
                    this.displayCard(card, "pile_discard", "pile_job_" + notif.args.playerId);

                    if (parseInt(notif.args.playerId) === this.player_id) {
                        this.myTable = notif.args.table;
                    }

                    this.discardCounter.setValue(this.discardCounter.getValue() + 1);
                    this.boardCounter[notif.args.playerId].job.setValue(this.boardCounter[notif.args.playerId].job.getValue() - 1);
                },
            }
    );
});