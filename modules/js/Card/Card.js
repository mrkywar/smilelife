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

    g_gamethemeurl + 'modules/js/Card/CardDisplay.js',
    g_gamethemeurl + 'modules/js/Card/CardType.js',
    g_gamethemeurl + 'modules/js/Card/CardSize.js',
], function (dojo, declare) {
    return declare(
            "smilelife.card",
            [
                smilelife.card.display,
                smilelife.card.size,
            ],
            {
                constructor: function () {
                    this.sizeAssoc = {
                        XS: PREF_CHOICE_SIZE_XS,
                        S: PREF_CHOICE_SIZE_S,
                        M: PREF_CHOICE_SIZE_M,
                        L: PREF_CHOICE_SIZE_L,
                        //"XL": PREF_CHOICE_SIZE_XL
                    };
                    this.computePossibleCardDimensions();


                },

                slideTemporary(html, container, sourceId, targetId, duration, delay) {
                    return new Promise((resolve, reject) => {
                        var animation = this.slideTemporaryObject(
                                html,
                                container,
                                sourceId,
                                targetId,
                                duration,
                                0,
                                );
                        setTimeout(() => {
                            resolve();
                        }, duration + delay);
                    });
                },

                isCardType(card, typeSearched) {
                    return this.getCardType(card) === typeSearched;
                },

                getCardType(card) {
                    return parseInt(card.dataset.type);
                },

                onCardClick: function (card) {
                    var searchedDiv = $('card_' + card.id);

                    if (this.isCurrentPlayerActive()) {
                        switch (this.actualState) {
                            case "takeCard":
                                if (!searchedDiv.classList.contains("selected")) {
                                    //select card
                                    if (this.isMyJob(card) || this.isMyMarriage(card) || undefined === card.type || 'discard' === card.location) {
                                        dojo.query("#game_container .selected").removeClass("selected");
                                        searchedDiv.classList.add("selected");
                                    } else {
                                        this.debug('CC-TC01');
                                    }
                                } else if (undefined === card.type) {
                                    //draw !
                                    this.doDraw();
                                } else if (this.isMyJob(card)) {
                                    //resign
                                    this.doResign();
                                } else if (this.isMyMarriage(card)) {
                                    //volontary divorce
                                    this.doDivorce();
                                } else if ('discard' === card.location) {
                                    //Play From Discard
                                    this.doPlayFromDiscard();
                                }
                                break;
                            case 'playCard':
                            case 'rainbowAction':
                                var btn_element = $('nobonus_button');
                                if (btn_element) {
                                    // Si l'élément existe, le supprimer
                                    dojo.destroy(btn_element);
                                }
                                
                                if (!searchedDiv.classList.contains("selected")) {
                                    //select card
                                    if ('hand' === card.location) {
                                        dojo.query(".selected").removeClass("selected");
                                        searchedDiv.classList.add("selected");

                                    } else {
                                        this.debug('CC-PC01');
                                    }
                                } else if ('hand' === card.location) {
                                    // play from hand
                                    this.doPlay();
                                }
                                break;

                            case 'researcherDiscard':
                                if (!searchedDiv.classList.contains("selected")) {
                                    //select card
                                    if ('hand' === card.location) {
                                        dojo.query(".selected").removeClass("selected");
                                        searchedDiv.classList.add("selected");

                                    } else {
                                        this.debug('CC-PC01');
                                    }
                                } else if ('hand' === card.location) {
                                    // Discard fromHand
                                    this.doDiscard();
                                }
                                break;
                        }


                    } else {
                        this.debug("OCC-S02 : Not your Turn !");
                    }
                }

            }
    );
});
