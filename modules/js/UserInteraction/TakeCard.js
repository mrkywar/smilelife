define([
    "dojo",
    "dojo/_base/declare",
], function (dojo, declare) {
    return declare(
            "smilelife.ui.takeCard",
            [],
            {
                constructor: function () {
                },

                addTakeCardInteraction: function () {
                    if (null !== this.myTable.job) {
                        if (this.myTable.job.isTemporary) {
                            this.addActionButton('resign_button', _('Resign and Play'), 'doResign', null, false, 'gray');
                        } else {
                            this.addActionButton('resign_button', _('Resign and Pass'), 'doResign', null, false, 'red');
                        }
                    }
                    if (null !== this.myTable.marriage) {
                        this.addActionButton('divorce_button', _('Voluntary Divorce'), 'doDivorce', null, false, 'red');
                    }
                    if (null !== this.myTable.adultery) {
                        this.addActionButton('adultery_button', _('Resign Adultery'), 'doAdulteryResign', null, false, 'gray');
                    }

                    this.addActionButton('drawCard_button', _('Draw from deck'), 'doDraw', null, false, 'blue');

                    if (null !== this.discard && this.discard.length > 0) {
                        this.addActionButton('playCard_button', _('Play from discard'), 'doPlayFromDiscard', null, false, 'blue');
                    }

                },

                doResign: function () {
                    this.takeAction('resign');
                },

                doDraw: function () {
                    this.takeAction('draw');
                },

                doPlayFromDiscard: function () {
                    var card = dojo.query('#card_' + this.discard[0].id);
                    if ('attack' === card[0].dataset.category && CARD_TYPE_ATTENTAT != card[0].dataset.type) {
                        this.attackModal(card[0]);
                    } else {
                        this.takeAction('playFromDiscard');
                    }
                },

                doDivorce: function () {
                    this.takeAction('divorceVoluntry');
                },

                doAdulteryResign: function () {
                    this.takeAction('adulteryResign');
                }

            }

    );
});

