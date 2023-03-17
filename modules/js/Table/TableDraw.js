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
                    $('pile_deck_count').innerHTML = this.gamedatas.deck;
                    
                    //--- display Discard infos
                    if(null === this.discard){
                        this.lastDiscardedCard = {
                            id:"empty"
                        };
                    }else{
                        this.lastDiscardedCard = this.discard[this.discard.length-1];
                        $('pile_discard_count').innerHTML = this.discard.length;
                    }
                    this.displayCard(this.lastDiscardedCard, "pile_discard");
                    
                },
                
                
                
               
            }
                    
                    
    );
});

            