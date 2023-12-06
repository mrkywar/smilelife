define([
    "dojo",
    "dojo/_base/declare",
], function (dojo, declare) {
    return declare(
            "smilelife.notification.card.casino",
            [],
            {
                notif_betNotification: function (notif)
                {
                    this.debug(notif.args);
                },
                
                notif_casinoResolvedNotification: function(notif) {
                    this.debug(notif.args);
                },
            }
    );
});