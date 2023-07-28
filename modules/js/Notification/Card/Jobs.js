define([
    "dojo",
    "dojo/_base/declare",
], function (dojo, declare) {
    return declare(
            "smilelife.notification.card.jobs",
            [],
            {
                notif_maxCardUpdateNotification: function (notif)
                {
                    this.maxhandCounters[notif.args.playerId].setValue(notif.args.cardMax);
                }
            }
    );
});