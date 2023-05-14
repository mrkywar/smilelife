define([
    "dojo",
    "dojo/_base/declare",
], function (dojo, declare) {
    return declare(
            "smilelife.table.attackModal",
            [],
            {
                attackModal: function (card) {
                    dojo.place(this.format_block('jstpl_attack_modale'), 'modal-container');

                    for (var playerId in this.gamedatas.tables) {
                        var player = this.gamedatas.tables[playerId].player;
//                        var btnHtml = this.format_block('jstpl_attack_btn', player);
                        this.debug('AM-PAM', player);
                        dojo.place(this.getAttackBtnHtml(player), 'attack_victim_selection');
                        dojo.connect($("attack" + player.id + "_button"), 'onclick', this, 'onTargetClick');
                    }

                    dojo.connect($("attackCancel_button"), 'onclick', this, 'onModalCloseClick');
                },

                getAttackBtnHtml: function (player) {
                    var textColor = "";
                    if (this.getHtmlColorLuma(player.color) > 100) {
                        textColor = "black";
                    } else {
                        textColor = "white";
                    }

                    return `
                        <a href="#" 
                            class="action-button bgabutton" 
                            onclick="return false;" 
                            data-player="` + player.id + `" 
                            id="attack` + player.id + `_button" *
                            style="background-color:#` + player.color + `;color:` + textColor + `">
                                ` + player.name + `
                        </a>
                    `;

                },

                onModalCloseClick: function (el) {
                    this.debug(el);
                    $('modal-container').innerHTML = "";
                },

                onTargetClick:function(el){
                    this.debug(el.target.dataset.player);
                }



            }
    );
});