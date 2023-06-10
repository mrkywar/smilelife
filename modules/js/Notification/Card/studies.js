define([
    "dojo",
    "dojo/_base/declare",
], function (dojo, declare) {
    return declare(
            "smilelife.notification.card.studies",
            [],
            {
                notif_studiesLevelUpdate: function (notif)
                {
                    this.studyCounters[notif.args.playerId].setValue(this.studyCounters[notif.args.playerId].getValue() + notif.args.level);
                }
            }
    );
});