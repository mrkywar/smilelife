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

                notif_flirtsAdultery: function (notif) {
                    for (var cardId in notif.args.cards) {
                        var card = notif.args.cards[cardId];
                        var cardDest = "pile_" + card.pile + "_" + notif.args.playerId;
                        this.displayCard(card, cardDest, "playerpanel_" + notif.args.playerId);
                    }

                    var pileSize = notif.args.cards.length;
                    if (
                            (parseInt(notif.args.playerId) === this.player_id && null !== this.myTable.marriage)
                            ||
                            (parseInt(notif.args.playerId) !== this.player_id && null !== this.otherTabes[notif.args.playerId].marriage)
                            ) {
                        pileSize = pileSize + 1;
                    }

                    this.boardCounter[notif.args.playerId].adultery.setValue(0);
                    this.boardCounter[notif.args.playerId].love.setValue(pileSize);
                }
            }
    );
});