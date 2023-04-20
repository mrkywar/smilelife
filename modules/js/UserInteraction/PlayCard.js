define([
    "dojo",
    "dojo/_base/declare",
], function (dojo, declare) {
    return declare(
            "smilelife.ui.playCard",
            [],
            {
                constructor: function () {
                    this.selectables = [];
                },

                addPlayCardInteraction: function () {
                    this.addActionButton('play_button', _('Play card'), 'doPlay', null, false, 'blue');
                    this.addActionButton('discard_button', _('Discard card and pass'), 'doPass', null, false, 'red');

                    var _this = this;

                    dojo.query("#myhand .cardontable").addClass("selectable");
                    this.selectables = dojo.query(".cardontable.selectable");
                    this.selectables.connect('onclick', this, evt => {
                        evt.preventDefault();
                        evt.stopPropagation();

                        _this.selectCard(evt.target);
                    });

                },

                selectCard: function (target) {
                    if ('' !== target.id && $(target.id).classList.contains("selectable")) {
                        this.debug(dojo.query(target.id), $(target.id));
                        if ($(target.id).classList.contains("selected")) {
                            $(target.id).classList.remove("selected");
                        } else {
                            dojo.query("#myhand .selected").removeClass("selected");
                            $(target.id).classList.add("selected");
                        }
                    } else {
                        this.selectCard(target.parentNode);
                    }
                },

                doPlay: function () {
                    var card = dojo.query(".selected");

                    if (1 !== card.length) {
                        this.showMessage(_('Invalid Card Selection'), "error");

                        dojo.query("#myhand .selected").removeClass("selected");
                    } else {
                        this.debug("DoPlay:", card[0]);

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
                        this.debug("DoPass", card[0]);
                        var data = {
                            card: card[0].dataset.id
                        };
                        this.takeAction('pass', data);
                    }
                },

            }

    );
});

