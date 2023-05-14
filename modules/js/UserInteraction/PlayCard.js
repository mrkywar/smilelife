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
                        dojo.query("#myhand .selected").removeClass("selected");
                    } else {
//                        this.debug("DoPlay:", card[0]);

                        var data = {
                            card: card[0].dataset.id
                        };
                        this.takeAction('playCard', data);
                    }
                },

                doPass: function () {
                    var card = dojo.query(".selected");

                    if (1 !== card.length) {
                        this.showMessage(_('Invalid Card Selection'), "error");
                        dojo.query("#myhand .selected").removeClass("selected");

                    } else {
//                        this.debug("DoPass", card[0]);
                        var data = {
                            card: card[0].dataset.id
                        };
                        this.takeAction('pass', data);
                    }
                },

            }

    );
});

