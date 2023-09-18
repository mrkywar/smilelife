define([
    "dojo",
    "dojo/_base/declare",
], function (dojo, declare) {
    return declare(
            "smilelife.table.discard",
            [],
            {
                updateDiscard: function () {
                    var finded = false;

                    for (var kCard = 0; kCard < this.discard.length - 1; kCard++) {
                        var card = this.discard[kCard];
                        var divCard = $('card_' + card.id);
                        if (null !== divCard) {
                            dojo.destroy(divCard);
                            finded = true;
                        }

                    }
                    if (!finded && this.discard.length > 0) {
                        var card = this.discard[this.discard.length - 1];
                        var lastVisible = dojo.query('#card_' + card.id);
                        this.debug(lastVisible);
                        if (0 === lastVisible.length) {
                            this.displayCard(card, 'pile_discard');
                        }
//                        this.displayCard(card, 'discard')
                    }
                }



            }
    );
});