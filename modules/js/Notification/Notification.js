define([
    'dojo',
    'dojo/_base/declare',

    g_gamethemeurl + 'modules/js/Notification/Resign.js',
    g_gamethemeurl + 'modules/js/Notification/Draw.js',
    g_gamethemeurl + 'modules/js/Notification/Pass.js',
    g_gamethemeurl + 'modules/js/Notification/Play.js',
    g_gamethemeurl + 'modules/js/Notification/Consequence.js',
    g_gamethemeurl + 'modules/js/Notification/volontaryDivorce.js',
    g_gamethemeurl + 'modules/js/Notification/Card/Studies.js',
    g_gamethemeurl + 'modules/js/Notification/Card/Flirts.js',
    g_gamethemeurl + 'modules/js/Notification/Card/Wage.js',
], function (dojo, declare) {
    return declare(
            'smilelife.notification',
            [
                smilelife.notification.resign,
                smilelife.notification.draw,
                smilelife.notification.pass,
                smilelife.notification.play,
                smilelife.notification.consequence,
                smilelife.notification.volontaryDivorce,
                smilelife.notification.card.studies,
                smilelife.notification.card.flirts,
                smilelife.notification.card.wage
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
                        ['flirtsAdultery', 500],
                        ['drawNotification', 500],
                        ['passNotification', 500],
                        ['playNotification', 500],
                        ['studiesLevelUpdate', 500],
                        ['resignNotification', 550],
                        ['playWageNotification', 500],
                        ['usedFlirtNotification', 500],
                        ['doublonFlirtNotification', 500],
                        ['discardNotification',500]
                        
                    ]
                    notifs.forEach(function (notif) {
                        dojo.subscribe(notif[0], _this, "notif_".concat(notif[0]));
                        _this.notifqueue.setSynchronous(notif[0], notif[1]);
                    });
                },
            }


    );
});