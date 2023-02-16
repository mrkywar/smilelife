define([
    'dojo',
    'dojo/_base/declare',
    'ebg/core/gamegui',
    g_gamethemeurl + 'modules/js/Core/ToolsTrait.js'
], function (dojo, declare) {
    return declare(
            'smilelife.DisplayCardTrait',
            [
                common.ToolsTrait
            ],
            {

                constructor: function () {
                    this.debug('smilelife.DisplayCardTrait constructor');
//                    this.handCards = [];
                },

                displayCards: function (gamedatas) {
                    this.debug("DCT - DisplayCards", gamedatas);

                    for (var cardId in gamedatas.myhand) {
                        this.debug(cardId, gamedatas.myhand[cardId]);
                        var card = gamedatas.myhand[cardId];
                        
                        dojo.place(this.format_block('jstpl_card', card), 'myhand');
                    }


                },
            }




    );
});
