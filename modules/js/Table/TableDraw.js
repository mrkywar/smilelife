define([
    "dojo",
    "dojo/_base/declare",
], function (dojo, declare) {
    return declare(
            "smilelife.table.draw",
            [],
            {

                displayDeckAndDiscard: function () {
                    this.deck = this.gamedatas.deck;
                    this.discard = this.gamedatas.discard;
                    this.offside = this.gamedatas.offside;

                    //--- display Deck infos
                    var drawCard = {
                        id: "deck"
                    };
                    this.displayCard(drawCard, "pile_deck");
                    var pileDeckCounter = new ebg.counter();
                    pileDeckCounter.create('pile_deck_count');
                    pileDeckCounter.setValue(this.gamedatas.deck);
                    this.deckCounter = pileDeckCounter;

                    //--- display Discard infos
                    if (null !== this.discard && 0 !== this.discard.length) {
                        this.lastDiscardedCard = this.discard[this.discard.length - 1];

                        this.displayCard(this.lastDiscardedCard, "pile_discard");
                    }
                    var pileDiscardCounter = new ebg.counter();
                    pileDiscardCounter.create('pile_discard_count');
                    pileDiscardCounter.setValue((null === this.discard) ? 0 : this.discard.length);
                    this.discardCounter = pileDiscardCounter;

                    //--- display Offside infos
                    if (null !== this.offside) {
                        this.lastOffsidedCard = this.offside[this.offside.length - 1];

                        this.displayCard(this.lastOffsidedCard, "pile_offside");
                    }
                    var pileOffsideCounter = new ebg.counter();
                    pileOffsideCounter.create('pile_offside_count');
                    pileOffsideCounter.setValue((null === this.offside) ? 0 : this.offside.length);
                    this.offsideCounter = pileOffsideCounter;
                },

                displayCasinoCards: function () {
                    this.casino = this.gamedatas.casino;

                    for (var cardId in this.casino) {
                        var card = this.casino[cardId];
                        this.displayCard(card, "pile_casino");
                    }

                    var pileCasinoCounter = new ebg.counter();
                    pileCasinoCounter.create('pile_casino_count');
                    pileCasinoCounter.setValue((null === this.casino && this.casino.length > 0) ? null : this.casino.length);
                    this.casinoCounter = pileCasinoCounter;

                },

            }


    );
});

            