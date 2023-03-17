define([
    'dojo',
    'dojo/_base/declare',

    g_gamethemeurl + 'modules/js/Notification/Resign.js',
    g_gamethemeurl + 'modules/js/Notification/Draw.js',
], function (dojo, declare) {
    return declare(
            'smilelife.notification',
            [
                smilelife.notification.resign,
                smilelife.notification.draw
            ],
            {
                constructor: function () {
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
                    var _this = this;

                    var notifs = [
                        ['resignNotification', 3000],
                        ['drawNotification', 3000]
                    ]
                    notifs.forEach(function (notif) {
                        dojo.subscribe(notif[0], _this, "notif_".concat(notif[0]));
                        _this.notifqueue.setSynchronous(notif[0], notif[1]);
                    });
                },
            }


    );
});