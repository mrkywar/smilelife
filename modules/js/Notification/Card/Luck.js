define([
    "dojo",
    "dojo/_base/declare",
], function (dojo, declare) {
    return declare(
            "smilelife.notification.card.luck",
            [],
            {
                notif_luckNotification: function (notif)
                {
                    if (parseInt(notif.args.playerId) === this.player_id) {
                        this.luckCards = notif.args.vision;
                        var modalTitle = _('This is your vision');
                        this.openModal(modalTitle, MODAL_TYPE_DISPLAY, null, notif.args.vision);
                    }
                }
            }
    );
});