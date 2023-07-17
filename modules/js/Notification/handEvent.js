define([
    "dojo",
    "dojo/_base/declare",
], function (dojo, declare) {
    return declare(
            "smilelife.notification.hand.events",
            [],
            {
                notif_handChangedNotification:function (notif){
                    this.myHand = notif.args.cards;
                    this.displayMyHand();
                },
                
                notif_trocNotification:function (notif){
                    this.debug("HE-TN",notif.args);
                }
            }
    );
});