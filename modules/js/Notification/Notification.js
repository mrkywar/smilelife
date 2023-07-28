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
    g_gamethemeurl + 'modules/js/Notification/Card/Jobs.js',
    g_gamethemeurl + 'modules/js/Notification/handEvent.js',
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
                smilelife.notification.card.wage,
                smilelife.notification.card.jobs,
                smilelife.notification.hand.events
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
                        ['flirtsAdultery', 200],
                        ['drawNotification', 200],
                        ['passNotification', 200],
                        ['playNotification', 200],
                        ['studiesLevelUpdate', 200],
                        ['wageLevelUpdate', 200],
                        ['resignNotification', 200],
                        ['usedFlirtNotification', 200],
                        ['doublonFlirtNotification', 200],
                        ['discardNotification',200],
                        ['turnpassNotification',200],
                        ['offsideNotification',200],
                        ['handChangedNotification',200],
                        ['trocNotification',200],
                        ['maxCardUpdateNotification',200]
                        
                    ]
                    notifs.forEach(function (notif) {
                        dojo.subscribe(notif[0], _this, "notif_".concat(notif[0]));
                        _this.notifqueue.setSynchronous(notif[0], notif[1]);
                    });
                },
            }


    );
});