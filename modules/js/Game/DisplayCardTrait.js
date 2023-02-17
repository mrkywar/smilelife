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
                },

                displayCards: function (gamedatas) {
                    //this.debug("DCT - DisplayCards", gamedatas);

                    for (var cardId in gamedatas.myhand) {
                        this.debug(cardId, gamedatas.myhand[cardId]);
                        var card = gamedatas.myhand[cardId];
                        card.id = cardId;

                        dojo.place(this.displayCard(card), 'myhand');
                    }
                },

                displayCard: function (card) {
                    return `
                        <div class="cardontable card_` + card.type + ` ` + card.shortclass + `" id="` + card.location + "_card_" + card.id + `" data-id="` + card.id + `">
                            <span class="card_text card_title">` + card.title + `</span>
                            <span class="card_text card_subtitle">` + card.subtitle + `</span>
                            <span class="card_text card_text1">` + card.text1 + `</span>
                            <span class="card_text card_text2">` + card.text2 + `</span>
                            <span class="debug">` + card.type + " - S : " + card.smilePoints + `</span>
                        </div>`;
                }


            }




    );
});
