define([
    "dojo",
    "dojo/_base/declare",
], function (dojo, declare) {
    return declare(
            "smilelife.table.discard",
            [],
            {
                updateDiscard: function () {
                    for (var kCard = 0; kCard < this.discard.length - 1; kCard++) {
                        var card = this.discard[kCard];
                        var divCard = $('card_' + card.id);
                        if (null !== divCard) {
                            dojo.destroy(divCard);
                        }
                        this.debug('D-UDDD', card, divCard);
                    }
                }



            }
    );
});