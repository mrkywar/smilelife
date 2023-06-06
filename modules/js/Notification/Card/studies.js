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
//                    this.debug(notif, notif.args.level, this.boardCounter[notif.args.playerId].job.getValue());
                    this.studyCounters[notif.args.playerId].setValue(this.studyCounters[notif.args.playerId].getValue() + notif.args.level);

                }
            }
    );
});