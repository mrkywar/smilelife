const SPRITE_NB_COLUMNS = 15;
const SPRITE_NB_ROWS = 7;

const WIDTH_S = 100;
const HEIGHT_S = 150;
const RADIUS_S = 5;


const PREF_CARD_SIZE = 500;

const PREF_CHOICE_SIZE_XS = 5001;
const PREF_CHOICE_SIZE_S = 5002;
const PREF_CHOICE_SIZE_M = 5003;
const PREF_CHOICE_SIZE_L = 5004;
const PREF_CHOICE_SIZE_XL = 5005;

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
                    this.sizeAssoc = {
                        "XS": PREF_CHOICE_SIZE_XS,
                        "S": PREF_CHOICE_SIZE_S,
                        "M": PREF_CHOICE_SIZE_M,
                        "L": PREF_CHOICE_SIZE_L,
                        "XL": PREF_CHOICE_SIZE_XL
                    };
                },
                displayCards: function (gamedatas) {

                    var size = this.findActualCardSize();
                    this.debug("DCT", size);

                    for (var cardId in gamedatas.myhand) {
//                        this.debug(cardId, gamedatas.myhand[cardId]);
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
                },

                findActualCardSize: function () {
                    var object = this.sizeAssoc;
                    var value = this.getUserPreference(PREF_CARD_SIZE);
//                    var prefSize = this.getUserPreference(PREF_CARD_SIZE)

                    return Object.keys(object).find(
                            key => object[key] === value
                    );
                }

            }




    );
});
