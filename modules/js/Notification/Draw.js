define([
    'dojo',
    'dojo/_base/declare',
], function (dojo, declare) {
    return declare(
            'smilelife.notification.draw',
            [
                //smilelife.state.draw
            ],
            {
                notif_resignNotification: function (notif) {
                    this.debug("callback called", notif);
                },

                notif_drawNotification: function (notif) {
//                    this.debug("drawcallback called", notif);


//                    var cardId = Date.now().toString();
                    if (parseInt(notif.args.playerId) === this.player_id) {
                        var card = notif.args.card;
                        this.displayCard(card, "myhand", "card_deck");

//                        this.slideTemporaryObject(
//                                this.displayCard(card),
//                                "card_0",
//                                "hand_card_" + card.id,
//                                "hand_card_5"
//                                ).play();





//                        dojo.place(this.displayCard(card), 'card_0');


                        //slide annimation
                        //slideTemporaryObject( mobile_obj_html: string, parent: ElementOrId, from: ElementOrId, to: ElementOrId, duration?: number, delay?: number ): Animation

//This method is useful when you want to slide a temporary HTML object from one place to another. As this object does not exists before the animation and won't remain after, it could be complex to create this object (with dojo.place), to place it at its origin (with placeOnObject) to slide it (with slideToObject) and to make it disappear at the end.
//
//slideTemporaryObject does all of this for you:
//
//mobile_obj_html is a piece of HTML code that represent the object to slide.
//parent is the ID of an HTML element of your interface that will be the parent of this temporary HTML object.
//from is the ID of the origin of the slide.
//to is the ID of the target of the slide.
//duration/delay works exactly like in "slideToObject"
//Example:
//
//this.slideTemporaryObject( '<div class="token_icon"></div>', 'tokens', 'my_origin_div', 'my_target_div' ).play();
//                        this.slideToObject("hand_card_" + card.id, "myhand",500).play();


//                        var _this = this;
//                        dojo.connect(temporary, 'onEnd', function () {
////                            dojo.place(_this.displayCard(card), 'myhand');
//                            dojo.place(this.displayCard(card), 'myhand');
//                        });

//                        //place a fake card
//                        var cardId = Date.now().toString();
//                        dojo.place(this.getDefaultCardHtml(cardId),"card_0");
//                        
//                        //slide annimation
//                        var drawSlideAnimation = this.slideToObjectAndDestroy("temp_"+cardId,"myhand");
//                        
//                        //display
//                        dojo.connect(animation_id, 'onEnd', ()->{
//                        var card = notif.args.card;
//                        dojo.place(this.displayCard(card), 'myhand');
//                        // do something here
//});
                    } else {
                        this.debug("Not Implemented Yet");
                    }



                    //                    var collection = {
//                        collection_index: datas.args.collectionIndex,
//                        player_id: datas.args.playerId
//                    };
//
//                    var collDestination = "playertable_" + datas.args.playerId;
//                    dojo.place(this.format_block('jstpl_collection', collection), collDestination);
//                    var collectionDiv = "collection_" + datas.args.playerId + "_" + datas.args.collectionIndex;
//
//                    for (var cardId in datas.args.cards) {
//                        var card = datas.args.cards[cardId];
//
//                        var divId = "hand_card_" + card.card_id;
//                        if (parseInt(datas.args.playerId) === this.player_id) {
//                            this.slideToObjectAndDestroy(divId, collectionDiv);
//                        } else {
//                            this.debug("NPN - NOT IMPLENTED PART");
//                        }
//                        dojo.place(this.format_block('jstpl_card', card), collectionDiv);
//
//                    }
                },
            }
    );
});