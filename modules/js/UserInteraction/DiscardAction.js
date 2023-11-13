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
                   var card = dojo.query("#myhand .selected");
                   this.debug("UI-DA-od",card)

                    if (1 !== card.length) {

                        this.showMessage(_('Invalid Card Selection'), "error");
                        dojo.query(".selected").removeClass("selected");
                    } else {
//                        var playedCard = card[0];
//                        this.playData = {
//                            card: playedCard.dataset.id
//                        };
//
//                        this.cardPlay(playedCard, 'playCard');
                    }
                },

            }

    );
});

