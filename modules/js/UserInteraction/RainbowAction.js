define([
    "dojo",
    "dojo/_base/declare",
], function (dojo, declare) {
    return declare(
            "smilelife.ui.rainbowAction",
            [],
            {
                constructor: function () {
                },

                addRainbowInteraction: function () {
                    this.addActionButton('play_button', _('Play card'), 'doPlay', null, false, 'blue');
                    this.addActionButton('stop_rainbow_button', _('End Bonus '), 'doStopRainbow', null, false, 'red');
                },

                doStopRainbow: function () {
                    this.takeAction('rainbowStop');
                }


            }

    );
});

