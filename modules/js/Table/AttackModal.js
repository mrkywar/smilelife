define([
    "dojo",
    "dojo/_base/declare",
], function (dojo, declare) {
    return declare(
            "smilelife.table.attackModal",
            [],
            {
                prepareAttackModal: function () {
                    var gamedatas = this.gamedatas;

                    for (var playerId in gamedatas.players) {
                        var player = gamedatas.players[playerId];
//                        var btnHtml = this.format_block('jstpl_attack_btn', player);
                        this.debug('AM-PAM',player);
//                        dojo.place(btnHtml, "attack_victim_selection");
                    }
                },
                
                
                
            }
    );
});