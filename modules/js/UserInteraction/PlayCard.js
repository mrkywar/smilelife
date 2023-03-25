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
                    this.debug("DoPlay:");
                },

            }

    );
});

