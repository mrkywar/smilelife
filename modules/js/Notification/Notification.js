const ANNIMATION_TIMER = 400;


define([
    'dojo',
    'dojo/_base/declare',

    g_gamethemeurl + 'modules/js/Notification/Resign.js',
    g_gamethemeurl + 'modules/js/Notification/Draw.js',
    g_gamethemeurl + 'modules/js/Notification/Pass.js',
    g_gamethemeurl + 'modules/js/Notification/Play.js',
    g_gamethemeurl + 'modules/js/Notification/Score.js',
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
                smilelife.notification.hand.events,
                smilelife.notification.score
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
                        ['flirtsAdultery', ANNIMATION_TIMER],
                        ['drawNotification', ANNIMATION_TIMER],
                        ['passNotification', ANNIMATION_TIMER],
                        ['playNotification', ANNIMATION_TIMER],
                        ['studiesLevelUpdate', ANNIMATION_TIMER],
                        ['wageLevelUpdate', ANNIMATION_TIMER],
                        ['resignNotification', ANNIMATION_TIMER],
                        ['usedFlirtNotification', ANNIMATION_TIMER],
                        ['doublonFlirtNotification', ANNIMATION_TIMER / 1.2],
                        ['discardNotification', ANNIMATION_TIMER],
                        ['turnpassNotification', ANNIMATION_TIMER * 2.2],
                        ['offsideNotification', ANNIMATION_TIMER],
                        ['handChangedNotification', ANNIMATION_TIMER],
                        ['trocNotification', ANNIMATION_TIMER],
                        ['maxCardUpdateNotification', ANNIMATION_TIMER],
                        ['handUpdateNotification', ANNIMATION_TIMER],
                        ['scoreNotification',0]

                    ]
                    notifs.forEach(function (notif) {
                        dojo.subscribe(notif[0], _this, "notif_".concat(notif[0]));
                        _this.notifqueue.setSynchronous(notif[0], notif[1]);
                    });
                },
            }


    );
});