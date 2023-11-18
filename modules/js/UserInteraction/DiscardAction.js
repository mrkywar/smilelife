define([
    "dojo",
    "dojo/_base/declare",
], function (dojo, declare) {
    return declare(
            "smilelife.ui.discardAction",
            [],
            {
                constructor: function () {
                },

                addDiscardInteraction: function () {
                    this.addActionButton('valid_button', _('Discard Card'), 'doDiscard', null, false, 'blue');
                },

                doDiscard: function () {
                    var cards = dojo.query("#myhand .selected");
                    this.debug("UI-DA-od", cards)

                    if (1 !== cards.length) {

                        this.showMessage(_('Invalid Card Selection'), "error");
                        dojo.query(".selected").removeClass("selected");
                    } else {
                        var discardedCard = {
                            card: cards[0].dataset.id
                        };
                        
                        this.takeAction('pass', discardedCard);
                    }
                },

            }

    );
});

