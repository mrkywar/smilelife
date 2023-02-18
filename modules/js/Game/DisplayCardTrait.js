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
                    this.cardDimension = this.computePossibleCardDimensions();
                },
                displayCards: function (gamedatas) {

                    var size = this.findActualCardSize();
                    this.debug("DCT", size);
                    this.applySize(size);

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

                    var gameOptionSize = Object.keys(object).find(
                            key => object[key] === value
                    );

                    return this.cardDimension[gameOptionSize]

                },

                computePossibleCardDimensions: function () {
                    var size_ratios = {"XS": .9, "S": 1, "M": 1.2, "L": 1.8, "XL": 2};
                    var card_dimensions_S = {"width": WIDTH_S, "height": HEIGHT_S, "radius": RADIUS_S};
                    card_dimensions = {"S": card_dimensions_S};

                    for (var size in size_ratios) {
                        // Compute card dimensions for this size
                        var ratio = size_ratios[size];

                        var width = ratio * card_dimensions_S.width;
                        var height = ratio * card_dimensions_S.height;
                        var radius = ratio * card_dimensions_S.radius;

                        card_dimensions[size] = {"width": width, "height": height, "radius": radius, "name": size};
                    }
                    return card_dimensions;
                },

                applySize: function (size) {
                    this.debug(size);
                    var computedCSS = `
                    /*----------------------------------------------------------
                                BEGIN - cards display COL 
                    ----------------------------------------------------------*/
                    `;
                    for (var col = 1; col <= SPRITE_NB_COLUMNS; col++) {
                        for (var row = 0; row < SPRITE_NB_ROWS; row++) {
                            computedCSS += `
                                .card_` + (col + row * SPRITE_NB_COLUMNS) + ` {
                                    background-position-x: -` + (col * size.width) + `px;
                                }
                                `;
                        }
                    }
                    computedCSS += `
                    /*----------------------------------------------------------
                                BEGIN - cards display LINE 
                    ----------------------------------------------------------*/
                    `;
                    for (var row = 1; row < SPRITE_NB_ROWS; row++) {
                        for (var col = 0; col <= SPRITE_NB_COLUMNS; col++) {
                            computedCSS += `
                                .card_` + (col + row * SPRITE_NB_COLUMNS) + ` {
                                    background-position-y: -` + (row * size.height) + `px;
                                }
                                `;
                        }

                    }

                    this.insertCSS(computedCSS);


                }


            }

    );
});
