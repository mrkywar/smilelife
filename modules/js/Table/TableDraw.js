define([
    "dojo",
    "dojo/_base/declare",
], function (dojo, declare) {
    return declare(
            "smilelife.table.draw",
            [],
            {
                constructor: function () {
                },
                
                
                displayDeckAndDiscard: function(){
                    this.deck = this.gamedatas.deck;
                    this.discard = this.gamedatas.discard;
                    
                    //--- display Deck infos
                    var drawCard = {
                        id:"deck"
                    };
                    this.displayCard(drawCard, "pile_deck");
                    var pileDeckCounter = new ebg.counter();
                    pileDeckCounter.create('pile_deck_count');
                    pileDeckCounter.setValue(this.gamedatas.deck);
                    this.deckCounter = pileDeckCounter;
                    
                    //--- display Discard infos
                    if(null === this.discard){
                        this.lastDiscardedCard = {
                            id:"empty"
                        };
                    }else{
                        this.lastDiscardedCard = this.discard[this.discard.length-1];

                    }
                    this.debug('ldc',this.lastDiscardedCard);
                    this.displayCard(this.lastDiscardedCard, "pile_discard");
                    var pileDiscardCounter = new ebg.counter();
                    pileDiscardCounter.create('pile_discard_count');
                    pileDiscardCounter.setValue((null === this.discard)?0:this.discard.length);
                    this.discardCounter = pileDiscardCounter;
                    
                },
                
                
                
               
            }
                    
                    
    );
});

            