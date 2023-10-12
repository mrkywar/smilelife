define([
    "dojo",
    "dojo/_base/declare",
], function (dojo, declare) {
    return declare(
            "smilelife.notification.card.medium",
            [],
            {
                notif_showCardsNotification: function (notif)
                {
                    var modalTitle = _('This is your vision');
                    this.openModal(modalTitle, MODAL_TYPE_DISPLAY, null, notif.args.cards);
                }
            }
    );
});