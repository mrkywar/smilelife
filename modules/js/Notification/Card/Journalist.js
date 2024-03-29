define([
    "dojo",
    "dojo/_base/declare",
], function (dojo, declare) {
    return declare(
            "smilelife.notification.card.journalist",
            [],
            {
                notif_showPlayerCardsNotification: function (notif)
                {
                    if (parseInt(notif.args.playerId) === this.player_id) {
                        var modalTitle = _('This is the results of your investigation');
                        this.openModal(modalTitle, MODAL_TYPE_DISPLAY_MULTI, null, notif.args.vision);
                    }
                }
            }
    );
});