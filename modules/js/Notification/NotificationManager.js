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
//                    dojo.connect(this.notifqueue, 'addToLog', function () {
//                        return _this.addLogClass();
//                    });

                    var notifs = [
                        ['resignNotification', 3000],
                        ['drawNotification', 3000]
                    ]
                    notifs.forEach(function (notif) {
//                        _this.debug(notif[0], "notif_".concat(notif[0]));
                        dojo.subscribe(notif[0], _this, "notif_".concat(notif[0]));
                        _this.notifqueue.setSynchronous(notif[0], notif[1]);
                    });

                    // TODO: here, associate your game notifications with local methods

                    // Example 1: standard notification handling
                    // dojo.subscribe( 'cardPlayed', this, "notif_cardPlayed" );

                    // Example 2: standard notification handling + tell the user interface to wait
                    //            during 3 seconds after calling the method in order to let the players
                    //            see what is happening in the game.
                    // dojo.subscribe( 'cardPlayed', this, "notif_cardPlayed" );
                    // this.notifqueue.setSynchronous( 'cardPlayed', 3000 );
                    // 
                },

                ///////////////////////////////////////////////////
                //// All notifications

                notif_resignNotification: function (notif) {
                    this.debug("callback called", notif);
                },

                notif_drawNotification: function (notif) {
                    this.debug("drawcallback called", notif);
                }
            }

    );
});
