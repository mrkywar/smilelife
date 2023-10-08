define([
    'dojo',
    'dojo/_base/declare',
], function (dojo, declare) {
    return declare(
            'smilelife.notification.volontaryDivorce',
            [
                //smilelife.state.draw
            ],
            {
                notif_childsAdultery: function (notif) {
                    for (var cardId in notif.args.cards) {
                        var card = notif.args.cards[cardId];
                        this.displayCard(card, "pile_discard", "pile_" + card.pile + "_" + notif.args.playerId);
                    }

                    //-- Upd counter
                    this.boardCounter[notif.args.playerId].child.setValue(0);
                    this.discardCounter.setValue(this.discardCounter.getValue() + notif.args.cards.length);
                },

                notif_flirtsAdultery: function (notif) {
                    for (var cardId in notif.args.cards) {
                        var card = notif.args.cards[cardId];
                        var cardDest = "pile_" + card.pile + "_" + notif.args.playerId;
                        this.displayCard(card, cardDest, "playerpanel_" + notif.args.playerId);
                    }

                    //-- put Marriage on top
                    var mariageDest = "pile_love_" + notif.args.playerId;
                    if (parseInt(notif.args.playerId) === this.player_id) {
                        var cardMarriage = this.myTable.marriage;
                    } else {
                        var cardMarriage = this.gamedatas.tables[notif.args.playerId].marriage;
                    }
                    if (null !== cardMarriage) {
                        this.displayCard(cardMarriage, mariageDest, mariageDest);
                    }

                    //-- Upd counter
                    this.boardCounter[notif.args.playerId].adultery.setValue(1); //-- 1 for keep adultery
                    this.boardCounter[notif.args.playerId].love.setValue(this.boardCounter[notif.args.playerId].love.getValue() + notif.args.cards.length);
                }
            }
    );
});