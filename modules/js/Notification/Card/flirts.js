define([
    "dojo",
    "dojo/_base/declare",
], function (dojo, declare) {
    return declare(
            "smilelife.notification.card.flirts",
            [],
            {
                
                notif_doublonFlirtNotification: function (notif) {
                    this.doSteelCard(notif);
                },
                
            }
    );
});