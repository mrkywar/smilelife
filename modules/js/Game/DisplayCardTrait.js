const SPRITE_NB_COLUMNS = 15;
const SPRITE_NB_ROWS = 7;

//const WIDTH_S = 100;
//const HEIGHT_S = 150;
//const RADIUS_S = 5;
const WIDTH_XXL = 333.335;
const HEIGHT_XXL = 500;
const RADIUS_XXL = 10;

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
                        //"XL": PREF_CHOICE_SIZE_XL
                    };
                    this.cardDimension = this.computePossibleCardDimensions();

                    //this.dontPreloadImage(g_gamethemeurl + 'img/cards-XL.png');
                    this.dontPreloadImage(g_gamethemeurl + 'img/cards-L.png');
                    this.dontPreloadImage(g_gamethemeurl + 'img/cards-M.png');
                    this.dontPreloadImage(g_gamethemeurl + 'img/cards-S.png');
                    this.dontPreloadImage(g_gamethemeurl + 'img/cards-XS.png');

                },
                displayCards: function (gamedatas) {

                    var size = this.findActualCardSize();
                    this.debug("DCT-DC", size);
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
                    var value = parseInt(this.getUserPreference(PREF_CARD_SIZE));
//                    var prefSize = this.getUserPreference(PREF_CARD_SIZE)

                    this.debug("DCT-FACS");
                    this.debug(object, value);

                    var gameOptionSize = Object.keys(object).find(
                            key => object[key] === value
                    );

                    return this.cardDimension[gameOptionSize]

                },

                computePossibleCardDimensions: function () {
                    var size_ratios = {"XS": 0.3, "S": 0.35, "M": 0.4, "L": 0.5, "XL": 0.6};
                    var card_dimensions_XXL = {"width": WIDTH_XXL, "height": HEIGHT_XXL, "radius": RADIUS_XXL};
                    card_dimensions = {"XXL": card_dimensions_XXL};

                    for (var size in size_ratios) {
                        // Compute card dimensions for this size
                        var ratio = size_ratios[size];

                        var width = card_dimensions_XXL.width * ratio;
                        var height = card_dimensions_XXL.height * ratio;
                        var radius = card_dimensions_XXL.radius * ratio;

                        card_dimensions[size] = {"width": width, "height": height, "radius": radius, "name": size, "ratio": ratio};
                    }
                    return card_dimensions;
                },

                applySize: function (size) {
                    this.debug(size);
                    var computedCSS = `
                    .cardontable {
                        margin-bottom: ` + (10 * size.ratio) + `px;
                        margin-right: ` + (10 * size.ratio) + `px;
                        width: ` + size.width + `px;
                        height: ` + size.height + `px;
                        border-radius: ` + size.radius + `px;
                        background-image: url('` + g_gamethemeurl + `img/cards-` + size.name + `.png');
                    }
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

                    //-- just Cards CSS adjustements and add style to DOM :)
                    computedCSS += `
                    .card_text{
                        font-size: ` + (20 * size.ratio) + `px;
                        padding: ` + (4 * size.ratio) + `px 0;
                        margin: 0px ` + (32 * size.ratio) + `px;
                        
                    }
                    /*------              WAGE                            ----*/
                    .card_wage .card_text1, .card_wage .card_title{
                        height: ` + (20 * size.ratio) + `px;
                    }
                    .card_wage .card_title{
                        margin-top: ` + (60 * size.ratio) + `px;
                    }
                    .card_wage .card_text1{
                        margin-top: ` + (316 * size.ratio) + `px;
                    }
                    /*------              STUDIES                         ----*/
                    .card_studies .card_text1, .card_studies .card_title{
                        height: ` + (20 * size.ratio) + `px;
                    }
                    .card_studies .card_title{
                        margin-top: ` + (60 * size.ratio) + `px;
                    }
                    .card_studies .card_text1{
                        height: ` + (34 * size.ratio) + `px;
                        margin-left: ` + (40 * size.ratio) + `px;
                        margin-top: ` + (258 * size.ratio) + `px;
                        width: ` + (250 * size.ratio) + `px;
                    }
                    .card_studies .card_text2{
                        margin-top: ` + (18 * size.ratio) + `px;
                    }
                    /*------              FLIRT                           ----*/
                    .card_flirt .card_title{
                        margin-top: ` + (64 * size.ratio) + `px;
                    }
                    .card_flirt .card_text1{
                        margin-top: ` + (300 * size.ratio) + `px;
                        font-size: ` + (30 * size.ratio) + `px;
                        padding-bottom:0;
                    }
                    /*------              SPECIAL                         ----*/
                    .card_special .card_title{
                        margin-top: ` + (54 * size.ratio) + `px;
                    }
                    .card_special .card_text1{
                        margin: ` + (40 * size.ratio) + `px;
                        margin-top: ` + (320 * size.ratio) + `px;
                        margin-bottom: 0;
                    }
                    .card_specialcasino .card_text1{
                        margin-top: ` + (308 * size.ratio) + `px;
                        font-size: ` + (16 * size.ratio) + `px;
                    }
                    .card_specialinheritance .card_text1{
                        font-size: ` + (16 * size.ratio) + `px;
                    }
                    /*------              PET                             ----*/
                    .card_pet .card_title{
                        margin-top: ` + (32 * size.ratio) + `px;
                    }
                    .card_pet .card_text1{
                        margin-top: ` + (350 * size.ratio) + `px;
                    }
                    /*------              MARRIAGE                        ----*/
                    .card_wedding .card_title{
                        margin-top: ` + (60 * size.ratio) + `px;
                    }
                    .card_wedding .card_text1{
                        margin-top: ` + (57 * size.ratio) + `px;
                        width: ` + (60 * size.ratio) + `px;
                        font-size: ` + (12 * size.ratio) + `px;
                        display: none; //TODO see if we I18N cityname
                    }
                    /*------              JOB                             ----*/
                    .card_job .card_title{
                        margin-top: ` + (32 * size.ratio) + `px;
                        padding:0;
                    }
                    .card_job .card_subtitle{
                        font-size: ` + (16 * size.ratio) + `px;
                        margin-top: 0 ` + (60 * size.ratio) + `px;
                        padding-top:` + (6 * size.ratio) + `px;
                    }
                    .card_job .card_text1{
                        margin-top: ` + (340 * size.ratio) + `px;
                    }
                    /*------              REWARD                          ----*/
                    .card_reward .card_title{
                        margin-top: ` + (72 * size.ratio) + `px;
                    }
                    .card_nationalmedal .card_text1{
                        margin: 0 `+ (24 * size.ratio) +`px;
                        margin-top: ` + (20 * size.ratio) + `px;
                        width: ` + (104 * size.ratio) + `px;
                        float: right;
                    }
                    .card_nationalmedal .card_text2{
                        margin-top: ` + (300 * size.ratio) + `px;
                        font-size: ` + (19 * size.ratio) + `px;
                    }
                    /*------              ATTACK                          ----*/
                    .card_attack .card_title{
                        margin-top: ` + (50 * size.ratio) + `px;
                    }
                    .card_attack .card_text1{
                        margin-top: ` + (320 * size.ratio) + `px;
                        height: ` + (64 * size.ratio) + `px;
                    }
                    /*------              CHILD                           ----*/
                    .card_child .card_title{
                        margin-top: ` + (68 * size.ratio) + `px;
                    }
                    .card_child .card_text1{
                        margin-top: ` + (300 * size.ratio) + `px;
                        font-size: ` + (36 * size.ratio) + `px;
                    }
                    /*------              HOUSE                           ----*/
                    .card_house .card_title{
                        font-size: ` + (24 * size.ratio) + `px;
                        margin-top: ` + (40 * size.ratio) + `px;
                        padding-right: ` + (20 * size.ratio) + `px;
                    }
                    .card_house .card_text1{
                        margin: ` + (40 * size.ratio) + `px;
                        margin-top: ` + (280 * size.ratio) + `px;
                        margin-bottom: 0;
                        height: ` + (20 * size.ratio) + `px;
                    }
                    .card_house .card_text2{
                        margin-top: ` + (54 * size.ratio) + `px;
                        font-size: ` + (18 * size.ratio) + `px;
                    }
                    /*------              TRAVEL                           ----*/
                    .card_travel .card_title{
                        margin-top: ` + (20 * size.ratio) + `px;
                        font-size: ` + (24 * size.ratio) + `px;
                    }
                    .card_travel .card_text1{
                        margin-top: ` + (340 * size.ratio) + `px;
                        margin-left: ` + (90 * size.ratio) + `px;
                        width: ` + (80 * size.ratio) + `px;
                    }
                    .card_travel .card_subtitle{
                        margin-top: ` + (140 * size.ratio) + `px;
                        width: ` + (320 * size.ratio) + `px;
                        height: ` + (50 * size.ratio) + `px;
                        right: -` + (156 * size.ratio) + `px;
                        font-size: ` + (40 * size.ratio) + `px;
                        
                    }
                    .card_riodejaneiro .card_subtitle{
                        text-shadow: ` + (2 * size.ratio) + `px 0 0 #9fbf39,
                                     ` + (2 * size.ratio) + `px ` + (2 * size.ratio) + `px 0 #9fbf39,
                                     0 ` + (2 * size.ratio) + `px 0 #9fbf39, 
                                    -` + (2 * size.ratio) + `px ` + (2 * size.ratio) + `px 0 #9fbf39,
                                    -` + (2 * size.ratio) + `px 0 0 #9fbf39,
                                    -` + (2 * size.ratio) + `px -` + (2 * size.ratio) + `px 0 #9fbf39,
                                    0 -` + (2 * size.ratio) + `px 0 #9fbf39, 
                                    ` + (2 * size.ratio) + `px -` + (2 * size.ratio) + `px 0 #9fbf39;
                    }
                    .card_london .card_subtitle{
                        text-shadow: ` + (2 * size.ratio) + `px 0 0 #8b8d8d,
                                     ` + (2 * size.ratio) + `px ` + (2 * size.ratio) + `px 0 #8b8d8d,
                                     0 ` + (2 * size.ratio) + `px 0 #8b8d8d, 
                                    -` + (2 * size.ratio) + `px ` + (2 * size.ratio) + `px 0 #8b8d8d,
                                    -` + (2 * size.ratio) + `px 0 0 #8b8d8d,
                                    -` + (2 * size.ratio) + `px -` + (2 * size.ratio) + `px 0 #8b8d8d,
                                    0 -` + (2 * size.ratio) + `px 0 #8b8d8d, 
                                    ` + (2 * size.ratio) + `px -` + (2 * size.ratio) + `px 0 #8b8d8d;
                    }
                    .card_sydney .card_subtitle{
                        text-shadow: ` + (2 * size.ratio) + `px 0 0 #d6833a,
                                     ` + (2 * size.ratio) + `px ` + (2 * size.ratio) + `px 0 #d6833a,
                                     0 ` + (2 * size.ratio) + `px 0 #d6833a, 
                                    -` + (2 * size.ratio) + `px ` + (2 * size.ratio) + `px 0 #d6833a,
                                    -` + (2 * size.ratio) + `px 0 0 #9fbf39,
                                    -` + (2 * size.ratio) + `px -` + (2 * size.ratio) + `px 0 #d6833a,
                                    0 -` + (2 * size.ratio) + `px 0 #d6833a, 
                                    ` + (2 * size.ratio) + `px -` + (2 * size.ratio) + `px 0 #d6833a;
                    }
                    .card_newyork .card_subtitle{
                        text-shadow: ` + (2 * size.ratio) + `px 0 0 #323755,
                                     ` + (2 * size.ratio) + `px ` + (2 * size.ratio) + `px 0 #323755,
                                     0 ` + (2 * size.ratio) + `px 0 #323755, 
                                    -` + (2 * size.ratio) + `px ` + (2 * size.ratio) + `px 0 #323755,
                                    -` + (2 * size.ratio) + `px 0 0 #323755,
                                    -` + (2 * size.ratio) + `px -` + (2 * size.ratio) + `px 0 #323755,
                                    0 -` + (2 * size.ratio) + `px 0 #323755, 
                                    ` + (2 * size.ratio) + `px -` + (2 * size.ratio) + `px 0 #323755;
                    }
                    .card_cairo .card_subtitle{
                        text-shadow: ` + (2 * size.ratio) + `px 0 0 #f9e000,
                                     ` + (2 * size.ratio) + `px ` + (2 * size.ratio) + `px 0 #f9e000,
                                     0 ` + (2 * size.ratio) + `px 0 #f9e000, 
                                    -` + (2 * size.ratio) + `px ` + (2 * size.ratio) + `px 0 #f9e000,
                                    -` + (2 * size.ratio) + `px 0 0 #f9e000,
                                    -` + (2 * size.ratio) + `px -` + (2 * size.ratio) + `px 0 #f9e000,
                                    0 -` + (2 * size.ratio) + `px 0 #f9e000, 
                                    ` + (2 * size.ratio) + `px -` + (2 * size.ratio) + `px 0 #f9e000;
                    }
                    `;

                    this.insertCSS(computedCSS);


                }


            }

    );
});
