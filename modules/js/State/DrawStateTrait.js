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

                initalizeDraw: function () {
                    this.addActionButton('completeSelection_button', _('Play cards'), 'doDraw', null, false, 'red');
                    this.addActionButton('unselectSelection_button', _('Reset'), 'doDrawFromDiscard', null, false, 'gray');

                    dojo.connect("#deck_and_discard .cardontable", 'onContainer', (evt) => {
                        evt.preventDefault();
                        evt.stopPropagation();
                        this.onClickCard(this);
                    });
                },

                doDraw: function (evt) {
                    this.debug('doDraw',evt);
                },

                doDrawFromDiscard: function (evt) {
                    this.debug('doDrawFromDiscard',evt);
                },

                onContainer: function (evt) {
                    this.debug('doContainer', evt);
                }
            }


    );
});


