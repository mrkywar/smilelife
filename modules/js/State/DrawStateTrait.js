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


