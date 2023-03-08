
define([
    'dojo',
    'dojo/_base/declare',
    'ebg/core/gamegui',
    g_gamethemeurl + 'modules/js/Core/ToolsTrait.js'
], function (dojo, declare) {
    return declare(
            'smilelife.DisplayDrawAndDiscardTrait',
            [
                common.ToolsTrait
            ],
            {

                constructor: function () {
//                    this.debug('smilelife.DisplayDrawAndDiscardTrait constructor');

                },

                displayDeckAndDiscard: function (gamedatas) {


                    dojo.place(this.displayDeck(gamedatas), "deck_and_discard");
                    dojo.place(this.displayDiscard(gamedatas), "deck_and_discard");
                },

                displayDeck: function (gamedatas) {
                    if (0 == gamedatas.deck) {
                        return `
                        <div class="cardontable empty_pile cards_stack" id="deck" data-id="0">
                            <div id="deck_counter" class="pile_counter">` + gamedatas.deck + `</div>
                        </div>`;
                    } else {
                        return `
                        <div class="cardontable card_0 card_deck cards_stack" id="card_0" data-id="0">
                            <div id="deck_counter" class="pile_counter">` + gamedatas.deck + `</div>
                        </div>`;
                    }
                },

                displayDiscard: function (gamedatas) {
                    this.discard = gamedatas.discard;
                    if (null == gamedatas.discard) {
                        return `
                        <div class="cardontable empty_pile cards-stack" id="deck" data-id="0">
                            
                        </div>`;
                    } else {
                        return this.displayCard(gamedatas.discard);
                    }
                },
                
            }

    );
});
