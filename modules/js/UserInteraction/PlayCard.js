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
                        var playedCard = card[0];
                        this.debug(this.isCardType(playedCard, CARD_TYPE_JAIL), playedCard);

                        switch (this.getCardType(playedCard)) {
                            case CARD_TYPE_HEAD_OF_PURCHASING:
                            case CARD_TYPE_HEAD_OF_SALES:
                                this.additionalTrocCardModal(playedCard);
                                break;
                            case CARD_TYPE_JAIL:
                                this.jailModal(playedCard);
                                break;
                            default:
                                if ('attack' === playedCard.dataset.category && CARD_TYPE_ATTENTAT != playedCard.dataset.type) {
                                    this.attackModal(card);
                                } else {
                                    var data = {
                                        card: playedCard.dataset.id
                                    };
                                    this.takeAction('playCard', data);
                                }
                                break;
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

