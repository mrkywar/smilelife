define([
    'dojo',
    'dojo/_base/declare',
], function (dojo, declare) {
    return declare(
            'smilelife.notification.volontaryDivorce',
            [
                //smilelife.state.draw
            ],
            {
                notif_volontaryDivorceNotification: function (notif) {
                    var card = notif.args.card;
                    this.displayCard(card, "pile_discard", "pile_love_" + notif.args.playerId);

                    if (parseInt(notif.args.playerId) === this.player_id) {
                        this.myTable = notif.args.table;
                    }

                    this.boardCounter[notif.args.playerId].love.setValue(this.boardCounter[notif.args.playerId].love.getValue() - 1);
                },
            }
    );
});