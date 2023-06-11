define([
    "dojo",
    "dojo/_base/declare",
], function (dojo, declare) {
    return declare(
            "smilelife.notification.card.wage",
            [],
            {
                notif_playWageNotification: function (notif)
                {
                    this.notif_playNotification(notif);

                    this.wagesCounters[notif.args.playerId].setValue(this.wagesCounters[notif.args.playerId].getValue() + notif.args.wageAmount);
//                    this.debug('WN', notif.args.wageAmount);
                }
            }
    );
});