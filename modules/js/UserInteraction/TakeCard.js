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

                    if (null!== this.discard && this.discard.length > 0) {
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
                    var card = this.discard[this.discard.length - 1];
                    
                    var playedCard = dojo.query('#card_' + card.id);
                    dojo.addClass(playedCard[0], "selected");
                    this.cardPlay(playedCard[0],'playFromDiscard');
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

