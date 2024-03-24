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
                },
                notif_wagesSpentNotification: function (notif) {
                    this.myTable.wages = notif.args.wages;
                    var cardDest = "pile_wage_" + notif.args.playerId;

                    for (var kWage in notif.args.wages) {
                        var hCard = notif.args.wages[kWage];
                        this.displayCard(hCard, cardDest, cardDest);
                    }
                }
            }
    );
});
