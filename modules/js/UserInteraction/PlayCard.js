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

                    var _this = this;

                    dojo.query("#myhand .cardontable").addClass("selectable");
                    dojo.query(".cardontable.selectable").connect('onclick', this, evt => {
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
                        this.ajaxcall("/" + this.game_name + "/" + this.game_name + "/playCard.html", {
                            lock: true,
                            card: card[0].dataset.id
                        }, this, function (result) {
                            this.debug("Play :", result);
                        }, function (is_error) {
                            //--error
                            this.debug("Play fail:", is_error);
                        });
                    }
                },

                doPass: function () {
                    var card = dojo.query(".selected");

                    if (1 !== card.length) {
                        this.showMessage(_('Invalid Card Selection'), "error");
                        dojo.query("#myhand .selected").removeClass("selected");
                        
                    } else {
                        this.debug("DoPlay:", card[0]);
                        this.ajaxcall("/" + this.game_name + "/" + this.game_name + "/pass.html", {
                            lock: true,
                            card: card[0].dataset.id
                        }, this, function (result) {
                            this.debug("Pass :", result);
                            dojo.query(".selected").removeClass("selected");
                            dojo.query(".selectable").removeClass("selectable");

                        }, function (is_error) {
                            //--error
                            this.debug("Pass:", is_error);
                        });
                    }
                },

            }

    );
});
