define([
    "dojo",
    "dojo/_base/declare",
], function (dojo, declare) {
    return declare(
            "smilelife.ui.birthdayAction",
            [],
            {
                constructor: function () {

                },

                addBirthdayInteraction: function () {
                    this.addActionButton('resign_button', _('Choose the Gift'), 'doBirthdayOpenModal', null, false, 'blue');
                    this.doBirthdayOpenModal();
                },

                doBirthdayOpenModal: function () {
                    var modalTitle = _('Choose the wage to offer');
                    var id = this.openModal(modalTitle, MODAL_TYPE_BIRTHDAY, null, this.getUsableWages());
                },

                onWageBirthdayClick: function (playedCard, additionalCard, id) {
                    this.debug(playedCard, additionalCard, id);
                }
            }

    );
});

