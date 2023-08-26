define([
    "dojo",
    "dojo/_base/declare",
], function (dojo, declare) {
    return declare(
            "smilelife.ui.playCard",
            [],
            {
                constructor: function () {
                },

                addPlayCardInteraction: function () {
                    this.addActionButton('play_button', _('Play card'), 'doPlay', null, false, 'blue');
                    this.addActionButton('discard_button', _('Discard card and pass'), 'doPass', null, false, 'red');
                },

                doPlay: function () {
                    var card = dojo.query(".selected");
                    if (1 !== card.length) {

                        this.showMessage(_('Invalid Card Selection'), "error");
                        dojo.query(".selected").removeClass("selected");
                    } else {
                        this.debug("dpd",card[0].dataset.type, this.isCardType(card[0],CARD_TYPE_HEAD_OF_PURCHASING),this.isCardType(card[0],CARD_TYPE_HEAD_OF_SALES));
                        if (this.isCardType(card[0],CARD_TYPE_HEAD_OF_PURCHASING) || this.isCardType(card[0],CARD_TYPE_HEAD_OF_SALES) ) {
//                            this.debug(dojo.query("#myhand .cardontable"));
                            
                            this.additionalCardModal(card,dojo.query("#myhand .cardontable"));
//                            var data = {
//                                card: card[0].dataset.id
//                            };
//                            this.takeAction('cardRequirement', data);
                        } else if ('attack' === card[0].dataset.category && CARD_TYPE_ATTENTAT != card[0].dataset.type) {
                            this.attackModal(card);
                        } else {
                            var data = {
                                card: card[0].dataset.id
                            };
                            this.takeAction('playCard', data);
                        }
                    }
                },

                doPass: function () {
                    var card = dojo.query(".selected");

                    if (1 !== card.length) {
                        this.showMessage(_('Invalid Card Selection'), "error");
                        dojo.query(".selected").removeClass("selected");

                    } else {
                        var data = {
                            card: card[0].dataset.id
                        };
                        this.takeAction('pass', data);
                    }
                },

            }

    );
});

