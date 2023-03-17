define([
    "dojo",
    "dojo/_base/declare",
], function (dojo, declare) {
    return declare(
            "smilelife.table.draw",
            [],
            {
                constructor: function () {
                    this.debug("smilelife.table.draw constructor");
                },
                
                
                displayDeckAndDiscard: function(){
                    this.deck = this.gamedatas.deck;
                    this.discard = this.gamedatas.discard;
                    
                    var drawCard = {
                        id:"deck"
                    };
                    this.displayCard(drawCard, "deck_and_discard");
                    
                    if(null === this.discard){
                        this.discard = {
                            id:"empty"
                        };
                    }
                    this.displayCard(this.discard, "deck_and_discard");
                },
                
                
                
               
            }
                    
                    
    );
});

            