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
//                        evt.target.addClass("selected");

                    });

                },

                selectCard: function (target) {
                    if ('' !== target.id && $(target.id).classList.contains("selectable")) {
                        this.debug(dojo.query(target.id), $(target.id));
                        $(target.id).classList.add("selected");
                    } else {
                        this.selectCard(target.parentNode);
                    }
                },

                doPlay: function () {
                    this.debug("DoPlay:");
//                    this.ajaxcall("/" + this.game_name + "/" + this.game_name + "/resign.html", {
//                        lock: true
//                    }, this, function (result) {
//                        this.debug("Resign :", result);
//                    }, function (is_error) {
//                        //--error
//                        this.debug("Resign fail:", is_error);
//                    });
                },

                doPass: function () {
                    this.debug("DoPass:");
                },

            }

    );
});

