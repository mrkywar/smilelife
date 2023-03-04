define([
    'dojo',
    'dojo/_base/declare',
    'ebg/core/gamegui',
    g_gamethemeurl + 'modules/js/Core/ToolsTrait.js'
], function (dojo, declare) {
    return declare(
            'smilelife.state.draw',
            [
                common.ToolsTrait
            ],
            {

                constructor: function () {
//                    this.debug('smilelife.StatesManager constructor');
                },

                displayButton: function () {
                    if (null !== this.myTable.job) {
                        this.addActionButton('dismiss_button', _('Dismiss'), 'doDissmiss', null, false, 'red');
                    }
                    this.debug('DST', this.myTable);

                },

                doDissmiss: function () {
                    this.debug("dismiss");
                }

            }


    );
});


