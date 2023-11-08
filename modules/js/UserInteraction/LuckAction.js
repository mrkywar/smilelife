define([
    "dojo",
    "dojo/_base/declare",
], function (dojo, declare) {
    return declare(
            "smilelife.ui.luckAction",
            [],
            {
                constructor: function () {
                },

                addLuckChoiceInteraction: function () {
                    this.addActionButton('play_button', _('Show Cards'), 'doLuckChoice', null, false, 'blue');
                },

                doLuckChoice: function () {
                    var modalTitle = _('This is your choice');
                    this.openModal(modalTitle, MODAL_TYPE_LUCK_CHOICE, null, this.luckCards);
                },

            }

    );
});

