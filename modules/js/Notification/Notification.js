const ANNIMATION_TIMER = 400;


define([
    'dojo',
    'dojo/_base/declare',

    g_gamethemeurl + 'modules/js/Notification/Draw.js',
    g_gamethemeurl + 'modules/js/Notification/HandEvent.js',
    g_gamethemeurl + 'modules/js/Notification/Pass.js',
    g_gamethemeurl + 'modules/js/Notification/Play.js',
    g_gamethemeurl + 'modules/js/Notification/Resign.js',
    g_gamethemeurl + 'modules/js/Notification/Score.js',
    g_gamethemeurl + 'modules/js/Notification/VolontaryDivorce.js',
    g_gamethemeurl + 'modules/js/Notification/Card/Casino.js',
    g_gamethemeurl + 'modules/js/Notification/Card/Flirts.js',
    g_gamethemeurl + 'modules/js/Notification/Card/Jobs.js',
    g_gamethemeurl + 'modules/js/Notification/Card/Journalist.js',
    g_gamethemeurl + 'modules/js/Notification/Card/Luck.js',
    g_gamethemeurl + 'modules/js/Notification/Card/Medium.js',
    g_gamethemeurl + 'modules/js/Notification/Card/Studies.js',
    g_gamethemeurl + 'modules/js/Notification/Card/Wage.js',
], function (dojo, declare) {
    return declare(
            'smilelife.notification',
            [
                smilelife.notification.draw,
                smilelife.notification.hand.events,
                smilelife.notification.pass,
                smilelife.notification.play,
                smilelife.notification.resign,
                smilelife.notification.score,
                smilelife.notification.volontaryDivorce,

                smilelife.notification.card.casino,
                smilelife.notification.card.flirts,
                smilelife.notification.card.jobs,
                smilelife.notification.card.journalist,
                smilelife.notification.card.luck,
                smilelife.notification.card.medium,
                smilelife.notification.card.studies,
                smilelife.notification.card.wage,
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
                        ['betNotification', ANNIMATION_TIMER / 1.2],
                        ['casinoResolvedNotification', ANNIMATION_TIMER * 2],
                        ['childsAdultery', ANNIMATION_TIMER],
                        ['discardNotification', ANNIMATION_TIMER],
                        ['doublonFlirtNotification', ANNIMATION_TIMER / 1.2],
                        ['drawNotification', ANNIMATION_TIMER],
                        ['flirtsAdultery', ANNIMATION_TIMER],
                        ['handChangedNotification', ANNIMATION_TIMER],
                        ['handUpdateNotification', ANNIMATION_TIMER],
                        ['luckNotification', ANNIMATION_TIMER],
                        ['luckChoiceNotification', ANNIMATION_TIMER],
                        ['maxCardUpdateNotification', ANNIMATION_TIMER],
                        ['offsideNotification', ANNIMATION_TIMER],
                        ['passNotification', ANNIMATION_TIMER],
                        ['playNotification', ANNIMATION_TIMER],
                        ['resignNotification', ANNIMATION_TIMER],
                        ['showCardsNotification', ANNIMATION_TIMER],
                        ['showPlayerCardsNotification', ANNIMATION_TIMER],
                        ['scoreNotification', 0],
                        ['studiesLevelUpdate', 0],
                        ['openCasinoNotification', 0],
                        ['turnpassNotification', ANNIMATION_TIMER * 2.5],
                        ['trocNotification', ANNIMATION_TIMER],
                        ['usedFlirtNotification', ANNIMATION_TIMER],
                        ['wageLevelUpdate', 0]

                    ]
                    notifs.forEach(function (notif) {
                        dojo.subscribe(notif[0], _this, "notif_".concat(notif[0]));
                        _this.notifqueue.setSynchronous(notif[0], notif[1]);
                    });
                },
            }


    );
});