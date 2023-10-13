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
                    var modalTitle = _('This is your vision');
                    this.debug(notif);
//                    this.openModal(modalTitle, MODAL_TYPE_DISPLAY, null, notif.args.cards);
                }
            }
    );
});