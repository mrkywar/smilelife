define([
    'dojo',
    'dojo/_base/declare',
], function (dojo, declare) {
    return declare(
            'smilelife.NotificationManager',
            [
                //smilelife.state.draw
            ],
            {

                constructor: function () {
                    this.debug('smilelife.NotificationManager constructor');

                    this.setupNotifications();
                },

                ///////////////////////////////////////////////////
                //// Reaction to cometD notifications

                /*
                 setupNotifications:
                 
                 In this method, you associate each of your game notifications with your local method to handle it.
                 
                 Note: game notification names correspond to "notifyAllPlayers" and "notifyPlayer" calls in
                 your smilelife.game.php file.
                 
                 */
                setupNotifications: function ()
                {
                    this.debug('notifications subscriptions setup');

                    var _this = this;

                    var notifs = [
                        ['resignNotification', 3000],
                        ['drawNotification', 3000]
                    ]
                    notifs.forEach(function (notif) {
//                        _this.debug(notif[0], "notif_".concat(notif[0]));
                        dojo.subscribe(notif[0], _this, "notif_".concat(notif[0]));
                        _this.notifqueue.setSynchronous(notif[0], notif[1]);
                    });
                },

                ///////////////////////////////////////////////////
                //// All notifications

                notif_resignNotification: function (notif) {
                    this.debug("callback called", notif);
                },

                notif_drawNotification: function (notif) {
//                    this.debug("drawcallback called", notif);


                    var cardId = Date.now().toString();
                    if (parseInt(notif.args.playerId) === this.player_id) {
                        var card = notif.args.card;

                        dojo.place(this.displayCard(card), 'card_0');
                        

                        //slide annimation
                        var temporary = this.slideToObject("hand_card_" + card.id, "hand_card_5",500);
                        

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

                getDefaultCardHtml: function (id) {

                    return `
                        <div class="cardontable card_0 card_deck cards_stack" id="temp_` + id + `" data-id="0">
                            fake ?
                        </div>
                    `;
                }


            }

    );
});
