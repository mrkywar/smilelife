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
                    var modalTitle = _('This is the results of your investigation');
                    this.debug(notif);
                    this.openModal(modalTitle, MODAL_TYPE_DISPLAY_MULTI, null, notif.args.vision);
                }
            }
    );
});