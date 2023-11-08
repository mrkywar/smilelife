define([
    "dojo",
    "dojo/_base/declare",
], function (dojo, declare) {
    return declare(
            "smilelife.notification.card.luck",
            [],
            {
                notif_luckNotification: function (notif)
                {
                    if (parseInt(notif.args.playerId) === this.player_id) {
                        this.luckCards = notif.args.vision;
                        var modalTitle = _('This is your choice');
                        this.openModal(modalTitle, MODAL_TYPE_LUCK_CHOICE, null, notif.args.vision);
                    }
                },
                
                notif_luckChoiceNotification: function(notif){
                    if (parseInt(notif.args.playerId) === this.player_id) {
                        var card = notif.args.card;
                        this.displayCard(card, "myhand", "special-container");
                        
                        $("special-container").innerHTML="";
                    }else{
                        this.debug("L-NLCN", notif.args);
                    }
                }
            }
    );
});