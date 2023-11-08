define([
    "dojo",
    "dojo/_base/declare",
], function (dojo, declare) {
    return declare(
            "smilelife.notification.card.luck",
            [],
            {
                notif_luckNotification: function (notif)
                {
                    if (parseInt(notif.args.playerId) === this.player_id) {
                        this.luckCards = notif.args.vision;
                        var modalTitle = _('This is your choice');
                        this.openModal(modalTitle, MODAL_TYPE_LUCK_CHOICE, null, notif.args.vision);
                    }
                },

                notif_luckChoiceNotification: function (notif) {
                    this.debug("L-NLCN", notif.args);
                    if (parseInt(notif.args.playerId) === this.player_id) {
                        var card = notif.args.card;
                        this.displayCard(card, "myhand", "playerpanel_" + notif.args.playerId, true);

                        $("special-container").innerHTML = "";
                    }
                    this.debug("L-NLCN", notif.args);

                    for (var kCard in notif.args.refusedCards) {
                        this.displayCard(kCard, "pile_discard", "playerpanel_" + notif.args.playerId, true);
                    }
                    this.gamedatas.tables[notif.args.playerId] = notif.args.table;
                    this.discardCounter.setValue(this.discardCounter.getValue() + notif.args.refusedCards.length);

                }
            }
    );
});