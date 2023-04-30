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
                            this.addActionButton('resign_button', _('Resign and Play'), 'doResign', null, false, 'red');
                        } else {
                            this.addActionButton('resign_button', _('Resign and Pass'), 'doResign', null, false, 'red');
                        }
                    }

                    this.addActionButton('drawCard_button', _('Draw from deck'), 'doDraw', null, false, 'blue');

                    if (this.discard.length > 0) {
                        this.addActionButton('playCard_button', _('Play from discard'), 'doPlayFromDiscard', null, false, 'gray');
                    }

                },

                doResign: function () {
                    this.takeAction('resign');
                },

                doDraw: function () {
                    this.takeAction('draw');
                },

                doPlayFromDiscard: function () {
                    this.takeAction('playFromDiscard');
                }

            }

    );
});

