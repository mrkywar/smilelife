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
                //// All notifications

               

                

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
