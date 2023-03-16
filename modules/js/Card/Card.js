const SPRITE_NB_COLUMNS = 15;
const SPRITE_NB_ROWS = 7;
const WIDTH_XXL = 333.335;
const HEIGHT_XXL = 500;
const RADIUS_XXL = 10;
//-- Card Size Preference
const PREF_CARD_SIZE = 500;
const PREF_CHOICE_SIZE_XS = 5001;
const PREF_CHOICE_SIZE_S = 5002;
const PREF_CHOICE_SIZE_M = 5003;
const PREF_CHOICE_SIZE_L = 5004;
const PREF_CHOICE_SIZE_XL = 5005;

define([
    "dojo",
    "dojo/_base/declare",
], function (dojo, declare) {
    return declare(
            "smilelife.card",
            [],
            {
                constructor: function () {
                    this.debug("smilelife.card constructor");
//                    this.size = null;

                    this.sizeAssoc = {
                        XS: PREF_CHOICE_SIZE_XS,
                        S: PREF_CHOICE_SIZE_S,
                        M: PREF_CHOICE_SIZE_M,
                        L: PREF_CHOICE_SIZE_L,
                        //"XL": PREF_CHOICE_SIZE_XL
                    };
                    this.computePossibleCardDimensions();


                },

                displayCard: function (card, destinationDivId, fromDivId) {
                    var searchedDiv = $('card_' + card.id);

                    if (searchedDiv) { // Already Here
//                        //TODO !!
                    } else {
                        searchedDiv = document.createElement('div');
                        searchedDiv.id = "card_".concat(card.id);
                        searchedDiv.classList.add('cardontable');
                        searchedDiv.dataset.id = '' + card.id;

                        searchedDiv.innerHTML = `
                            <div class="card_sides">
                                <div class="card-side front" id="front_` + searchedDiv.id + `"></div>
                                <div class="card-side back"></div>
                            </div>
                        `;
                    }

                    if (fromDivId) {
                        var moveableCard = document.createElement('div');
                        moveableCard.id = "tempory_".concat(card.id);
                        moveableCard.classList.add('cardontable');
//                        moveableCard.classList.add('movableCard');
                        moveableCard.dataset.id = '' + card.id;
                        moveableCard.innerHTML = `
                            <div class="card_sides">
                                <div class="card-side front" id="front_` + moveableCard.id + `"></div>
                                <div class="card-side back"></div>
                            </div>
                        `;

//                        searchedDiv.style.display = "none";
                        
                        moveableCard.style.zIndex = 20;
                        $(destinationDivId).appendChild(searchedDiv);

                        if (card.type) {
                            this.displayCardInformations(searchedDiv, card);
//                            this.displayCardInformations(moveableCard, card);
                            this.debug("movable",moveableCard.id);
                        }

                        this.slideTemporaryObject(
                                moveableCard,
                                fromDivId,
                                "tempory_".concat(card.id),
                                searchedDiv.id,
                                500
                                );
//                        
                        this.debug("moveto",searchedDiv.id);

//                        setTimeout(function () {
//                            searchedDiv.style.display = "block";
//                        }, 500);


                    } else {
//                    this.debug(destinationDivId, searchedDiv);
                        $(destinationDivId).appendChild(searchedDiv);
                        if (card.type) {
                            this.displayCardInformations(searchedDiv, card);
                        }

                    }





                },

                displayCardInformations: function (div, card) {
                    div.dataset.points = card.smilePoints;
                    div.dataset.type = '' + card.type;
                    div.dataset.category = '' + card.category;
                    div.dataset.name = '' + card.name;

                    $("front_" + div.id).innerHTML = `
                        <span class="card_text card_title">` + card.title + `</span>
                        <span class="card_text card_subtitle">` + card.subtitle + `</span>
                        <span class="card_text card_text1">` + card.text1 + `</span>
                        <span class="card_text card_text2">` + card.text2 + `</span>
                        <span class="debug">` + card.id + " / " + card.type + " - S : " + card.smilePoints + `</span>
                    `;

                },

                computePossibleCardDimensions: function () {
                    var sizeRatios = {XS: 0.3, S: 0.35, M: 0.4, L: 0.5, XL: 0.6};
                    var cardDimensionsXXL = {width: WIDTH_XXL, height: HEIGHT_XXL, radius: RADIUS_XXL};
                    cardDimensions = {XXL: cardDimensionsXXL};
                    for (var size in sizeRatios) {
                        // Compute card dimensions for this size
                        var ratio = sizeRatios[size];
                        var width = cardDimensionsXXL.width * ratio;
                        var height = cardDimensionsXXL.height * ratio;
                        var radius = cardDimensionsXXL.radius * ratio;
                        cardDimensions[size] = {width: width, height: height, radius: radius, name: size, ratio: ratio};
                    }
                    this.aviableCardDimensions = cardDimensions;
                },

                findActualCardSize: function () {
                    var object = this.sizeAssoc;
                    var value = parseInt(this.getUserPreference(PREF_CARD_SIZE));
//                    this.debug("size : (" + value + ")")
                    var gameOptionSize = Object.keys(object).find(
                            key => object[key] === value
                    );
//                    this.debug("OPT : ",gameOptionSize);
//                    this.debug("Avi :",this.aviableCardDimensions);

                    return this.aviableCardDimensions[gameOptionSize];

                },

                applyCardSize: function () {
                    if (undefined === this.size) {
                        this.size = this.findActualCardSize();
                    }
                    this.debug('SIZE OBJ', this.size);
                    var size = this.size;

                    var computedCSS = `
                    .cardontable,
                    .pile{
                        width: ` + size.width + `px;
                        height: ` + size.height + `px;
                    }
                    
                    .cardontable {
                        margin-bottom: ` + (10 * size.ratio) + `px;
                        margin-right: ` + (10 * size.ratio) + `px;
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
                                .cardontable[data-type="` + (col + row * SPRITE_NB_COLUMNS) + `"] {
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
                                .cardontable[data-type="` + (col + row * SPRITE_NB_COLUMNS) + `"] {
                                    background-position-y: -` + (row * size.height) + `px;
                                }
                                `;
                        }

                    }

                    //-- just Cards CSS adjustements and add style to DOM :)
                    computedCSS += `
                    /*------              Draw                            ----*/
                    #aviableDraw .cardontable .card_in_deck{
                        font-size: ` + (40 * size.ratio) + `px;
                        text-shadow: : ` + (2 * size.ratio) + `px 0 0 white,
                                     ` + (2 * size.ratio) + `px ` + (2 * size.ratio) + `px 0 white,
                                     0 ` + (2 * size.ratio) + `px 0 white, 
                                    -` + (2 * size.ratio) + `px ` + (2 * size.ratio) + `px 0 white,
                                    -` + (2 * size.ratio) + `px 0 0 white,
                                    -` + (2 * size.ratio) + `px -` + (2 * size.ratio) + `px 0 white,
                                    0 -` + (2 * size.ratio) + `px 0 white, 
                                    ` + (2 * size.ratio) + `px -` + (2 * size.ratio) + `px 0 white;
                    }
                    
                    /*------              Card TEXT                       ----*/
                    .card_text{
                        font-size: ` + (20 * size.ratio) + `px;
                        padding: ` + (4 * size.ratio) + `px 0;
                        margin: 0px ` + (32 * size.ratio) + `px;
                        
                    }
                    /*------              WAGE                            ----*/
                    .cardontable[data-category="wage"] .card_text1, .cardontable[data-category="wage"] .card_title{
                        height: ` + (20 * size.ratio) + `px;
                    }
                    .cardontable[data-category="wage"] .card_title{
                        margin-top: ` + (66 * size.ratio) + `px;
                    }
                    .cardontable[data-category="wage"] .card_text1{
                        margin-top: ` + (316 * size.ratio) + `px;
                    }
                    /*------              STUDIES                         ----*/
                    .cardontable[data-category="studies"] .card_text1, .cardontable[data-category="studies"] .card_title{
                        height: ` + (20 * size.ratio) + `px;
                    }
                    .cardontable[data-category="studies"] .card_title{
                        margin-top: ` + (64 * size.ratio) + `px;
                    }
                    .cardontable[data-category="studies"] .card_text1{
                        height: ` + (34 * size.ratio) + `px;
                        margin-left: ` + (40 * size.ratio) + `px;
                        margin-top: ` + (258 * size.ratio) + `px;
                        width: ` + (250 * size.ratio) + `px;
                    }
                    .cardontable[data-category="studies"] .card_text2{
                        margin-top: ` + (20 * size.ratio) + `px;
                        height: ` + (18 * size.ratio) + `px;
                    }
                    /*------              FLIRT                           ----*/
                    .cardontable[data-category="flirt"] .card_title{
                        margin-top: ` + (64 * size.ratio) + `px;
                    }
                    .cardontable[data-category="flirt"] .card_text1{
                        margin-top: ` + (300 * size.ratio) + `px;
                        font-size: ` + (30 * size.ratio) + `px;
                        padding-bottom:0;
                    }
                    /*------              SPECIAL                         ----*/
                    .cardontable[data-category="special"] .card_title{
                        margin-top: ` + (54 * size.ratio) + `px;
                    }
                    .cardontable[data-category="special"] .card_text1{
                        margin: ` + (40 * size.ratio) + `px;
                        margin-top: ` + (320 * size.ratio) + `px;
                        margin-bottom: 0;
                    }
                    .cardontable[data-category="special"].cardontable[data-name="casino"] .card_text1{
                        margin-top: ` + (308 * size.ratio) + `px;
                        font-size: ` + (16 * size.ratio) + `px;
                    }
                    .cardontable[data-category="special"].cardontable[data-name="inheritance"] .card_text1{
                        font-size: ` + (16 * size.ratio) + `px;
                    }
                    .cardontable[data-category="special"].cardontable[data-name="jobboost"] .card_text1{
                        margin-top: ` + (308 * size.ratio) + `px;
                    }
                    /*------              PET                             ----*/
                    .cardontable[data-category="pet"] .card_title{
                        margin-top: ` + (32 * size.ratio) + `px;
                    }
                    .cardontable[data-category="pet"] .card_text1{
                        margin-top: ` + (350 * size.ratio) + `px;
                    }
                    .cardontable[data-name="unicorn"] .card_text1{
                        margin-top: ` + (338 * size.ratio) + `px;
                    }
                    /*------              MARRIAGE                        ----*/
                    .cardontable[data-category="marriage"] .card_title{
                        margin-top: ` + (63 * size.ratio) + `px;
                    }
                    .cardontable[data-category="marriage"] .card_text1{
                        margin-top: ` + (57 * size.ratio) + `px;
                        width: ` + (60 * size.ratio) + `px;
                        font-size: ` + (12 * size.ratio) + `px;
                        display: none; //TODO see if we I18N cityname
                    }
                    /*------              JOB                             ----*/
                    .cardontable[data-category="job"] .card_title,
                    .cardontable[data-category="powered_job"] .card_title,
                    .cardontable[data-category="official_job"] .card_title,
                    .cardontable[data-category="temporary_job"] .card_title{
                        margin-top: ` + (32 * size.ratio) + `px;
                        padding:0;
                    }
                    .cardontable[data-category="job"] .card_subtitle,
                    .cardontable[data-category="powered_job"] .card_subtitle,
                    .cardontable[data-category="official_job"] .card_subtitle,
                    .cardontable[data-category="temporary_job"] .card_subtitle{
                        font-size: ` + (16 * size.ratio) + `px;
                        margin-top: ` + (4 * size.ratio) + `px;
                        padding-top:` + (6 * size.ratio) + `px;
                    }
                    .cardontable[data-category="job"] .card_text1{
                        margin-top: ` + (360 * size.ratio) + `px;
                    }
                    .cardontable[data-category="temporary_job"] .card_text1,
                    .cardontable[data-category="official_job"] .card_text1
                    {
                        margin-top: ` + (340 * size.ratio) + `px;
                    }
                    .cardontable[data-category="powered_job"] .card_text1{
                        margin: 0 ` + (64 * size.ratio) + `px;
                        margin-top: ` + (352 * size.ratio) + `px;
                        height: ` + (56 * size.ratio) + `px;
                        line-height: 1.35em;
                    }
                    .cardontable[data-category="official_job"].cardontable[data-category="powered_job"] .card_text1{
                        margin-top: ` + (328 * size.ratio) + `px;
                    }
                    .cardontable[data-name="bandit"] .card_text1{
                        margin-left: ` + (56 * size.ratio) + `px;
                        margin-right: ` + (80 * size.ratio) + `px;
                    }
                    .cardontable[data-name="bandit"] .card_text2{
                        width: ` + (70 * size.ratio) + `px;
                        position: absolute;
                        right: -` + (28 * size.ratio) + `px;
                        bottom: -` + (8 * size.ratio) + `px;
                        font-size: ` + (16 * size.ratio) + `px;
                    }
                    .cardontable[data-name="grandprofessor"] .card_text1{
                        margin: ` + (332 * size.ratio) + `px ` + (46 * size.ratio) + `px 0 ` + (46 * size.ratio) + `px;
                    }
                    .cardontable[data-name="grandprofessor"] .card_text2{
                        position: absolute;
                        top: ` + (86 * size.ratio) + `px;
                        left: ` + (6 * size.ratio) + `px;
                        font-size: ` + (28 * size.ratio) + `px;
                        font-weight: bold;
                    }
                    /*------              REWARD                          ----*/
                    .cardontable[data-category="reward"] .card_title{
                        margin-top: ` + (72 * size.ratio) + `px;
                    }
                    .cardontable[data-name="freedommedal"] .card_title{
                        margin-top: ` + (78 * size.ratio) + `px;
                    }
                    .cardontable[data-name="nationalmedal"] .card_text1{
                        margin: 0 ` + (24 * size.ratio) + `px;
                        margin-top: ` + (20 * size.ratio) + `px;
                        width: ` + (104 * size.ratio) + `px;
                        float: right;
                    }
                    .cardontable[data-name="nationalmedal"] .card_text2{
                        margin-top: ` + (300 * size.ratio) + `px;
                        font-size: ` + (19 * size.ratio) + `px;
                    }
                    .cardontable[data-name="freedommedal"] .card_text1{
                        margin-top: ` + (286 * size.ratio) + `px;
                    }
                    /*------              ATTACK                          ----*/
                    .cardontable[data-category="attack"] .card_title{
                        margin-top: ` + (54 * size.ratio) + `px;
                    }
                    .cardontable[data-category="attack"] .card_text1{
                        margin: 0 ` + (40 * size.ratio) + `px;
                        margin-top: ` + (324 * size.ratio) + `px;
                        height: ` + (64 * size.ratio) + `px;
                    }
                    .cardontable[data-name="jail"] .card_text1,
                    .cardontable[data-name="incometax"] .card_text1{
                        font-size: ` + (18 * size.ratio) + `px;
                    }
                    /*------              CHILD                           ----*/
                    .cardontable[data-category="child"] .card_title{
                        margin-top: ` + (68 * size.ratio) + `px;
                    }
                    .cardontable[data-category="child"] .card_text1{
                        margin-top: ` + (300 * size.ratio) + `px;
                        font-size: ` + (36 * size.ratio) + `px;
                    }
                    /*------              HOUSE                           ----*/
                    .cardontable[data-category="house"] .card_title{
                        font-size: ` + (24 * size.ratio) + `px;
                        margin-top: ` + (40 * size.ratio) + `px;
                        padding-right: ` + (20 * size.ratio) + `px;
                    }
                    .cardontable[data-category="house"] .card_text1{
                        margin: ` + (40 * size.ratio) + `px;
                        margin-top: ` + (280 * size.ratio) + `px;
                        margin-bottom: 0;
                        height: ` + (20 * size.ratio) + `px;
                    }
                    .cardontable[data-category="house"] .card_text2{
                        margin-top: ` + (54 * size.ratio) + `px;
                        font-size: ` + (18 * size.ratio) + `px;
                    }
                    /*------              Adultery                        ----*/
                    .cardontable[data-category="adultery"] .card_title{
                        margin-top: ` + (56 * size.ratio) + `px;
                    }
                    .cardontable[data-category="adultery"] .card_text1{
                        margin: 0 ` + (44 * size.ratio) + `px;
                        margin-top: ` + (290 * size.ratio) + `px;
                        font-size: ` + (17 * size.ratio) + `px;
                        height: ` + (74 * size.ratio) + `px;
                        
                    }
                    /*------              TRAVEL                          ----*/
                    .cardontable[data-category="travel"] .card_title{
                        margin-top: ` + (20 * size.ratio) + `px;
                        font-size: ` + (24 * size.ratio) + `px;
                    }
                    .cardontable[data-category="travel"] .card_text1{
                        margin-top: ` + (350 * size.ratio) + `px;
                        margin-left: ` + (90 * size.ratio) + `px;
                        width: ` + (80 * size.ratio) + `px;
                    }
                    .cardontable[data-category="travel"] .card_subtitle{
                        margin-top: ` + (140 * size.ratio) + `px;
                        width: ` + (320 * size.ratio) + `px;
                        height: ` + (50 * size.ratio) + `px;
                        right: -` + (156 * size.ratio) + `px;
                        font-size: ` + (40 * size.ratio) + `px;
                        
                    }
                    .cardontable[data-name="riodejaneiro"] .card_subtitle{
                        text-shadow: ` + (2 * size.ratio) + `px 0 0 #9fbf39,
                                     ` + (2 * size.ratio) + `px ` + (2 * size.ratio) + `px 0 #9fbf39,
                                     0 ` + (2 * size.ratio) + `px 0 #9fbf39, 
                                    -` + (2 * size.ratio) + `px ` + (2 * size.ratio) + `px 0 #9fbf39,
                                    -` + (2 * size.ratio) + `px 0 0 #9fbf39,
                                    -` + (2 * size.ratio) + `px -` + (2 * size.ratio) + `px 0 #9fbf39,
                                    0 -` + (2 * size.ratio) + `px 0 #9fbf39, 
                                    ` + (2 * size.ratio) + `px -` + (2 * size.ratio) + `px 0 #9fbf39;
                    }
                    .cardontable[data-name="london"] .card_subtitle{
                        text-shadow: ` + (2 * size.ratio) + `px 0 0 #8b8d8d,
                                     ` + (2 * size.ratio) + `px ` + (2 * size.ratio) + `px 0 #8b8d8d,
                                     0 ` + (2 * size.ratio) + `px 0 #8b8d8d, 
                                    -` + (2 * size.ratio) + `px ` + (2 * size.ratio) + `px 0 #8b8d8d,
                                    -` + (2 * size.ratio) + `px 0 0 #8b8d8d,
                                    -` + (2 * size.ratio) + `px -` + (2 * size.ratio) + `px 0 #8b8d8d,
                                    0 -` + (2 * size.ratio) + `px 0 #8b8d8d, 
                                    ` + (2 * size.ratio) + `px -` + (2 * size.ratio) + `px 0 #8b8d8d;
                    }
                    .cardontable[data-name="sydney"] .card_subtitle{
                        text-shadow: ` + (2 * size.ratio) + `px 0 0 #d6833a,
                                     ` + (2 * size.ratio) + `px ` + (2 * size.ratio) + `px 0 #d6833a,
                                     0 ` + (2 * size.ratio) + `px 0 #d6833a, 
                                    -` + (2 * size.ratio) + `px ` + (2 * size.ratio) + `px 0 #d6833a,
                                    -` + (2 * size.ratio) + `px 0 0 #9fbf39,
                                    -` + (2 * size.ratio) + `px -` + (2 * size.ratio) + `px 0 #d6833a,
                                    0 -` + (2 * size.ratio) + `px 0 #d6833a, 
                                    ` + (2 * size.ratio) + `px -` + (2 * size.ratio) + `px 0 #d6833a;
                    }
                    .cardontable[data-name="newyork"] .card_subtitle{
                        text-shadow: ` + (2 * size.ratio) + `px 0 0 #323755,
                                     ` + (2 * size.ratio) + `px ` + (2 * size.ratio) + `px 0 #323755,
                                     0 ` + (2 * size.ratio) + `px 0 #323755, 
                                    -` + (2 * size.ratio) + `px ` + (2 * size.ratio) + `px 0 #323755,
                                    -` + (2 * size.ratio) + `px 0 0 #323755,
                                    -` + (2 * size.ratio) + `px -` + (2 * size.ratio) + `px 0 #323755,
                                    0 -` + (2 * size.ratio) + `px 0 #323755, 
                                    ` + (2 * size.ratio) + `px -` + (2 * size.ratio) + `px 0 #323755;
                    }
                    .cardontable[data-name="cairo"] .card_subtitle{
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
