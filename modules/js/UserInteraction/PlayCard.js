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
                        if ($(target.id).classList.contains("selected")) {
                            $(target.id).classList.remove("selected");
                        } else {
                            //-- TODO remove other !!
                            dojo.query("#myhand .selected").removeClass("selected");
                            $(target.id).classList.add("selected");
                        }
                    } else {
                        this.selectCard(target.parentNode);
                    }
                },

                doPlay: function () {
//                    this.debug("DoPlay:");
                    var card = dojo.query(".selected");
                    this.debug("DoPlay:", card);
                    if(1 !== card.length){
                        this.showMessage(_('Invalid Card Selection'), "error");
                        dojo.query("#myhand .selected").removeClass("selected");
                    }else{
                        this.ajaxcall("/" + this.game_name + "/" + this.game_name + "/playCard.html",{
                            lock: true,
//                            id: card.
                        }, this, function (result) {
                            this.debug("Play :", result);
                        }, function (is_error) {
                            //--error
                            this.debug("Play fail:", is_error);
                        });
                    }
//                    if()
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

