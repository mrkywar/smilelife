define([
    "dojo",
    "dojo/_base/declare",
], function (dojo, declare) {
    return declare(
            "smilelife.notification.card.wage",
            [],
            {
                notif_wageLevelUpdate: function (notif)
                {
                    this.wagesCounters[notif.args.playerId].setValue(this.wagesCounters[notif.args.playerId].getValue() + notif.args.level);
                    this.aviableWagesCounters[notif.args.playerId].setValue(this.aviableWagesCounters[notif.args.playerId].getValue() + notif.args.level);
                }
            }
    );
});