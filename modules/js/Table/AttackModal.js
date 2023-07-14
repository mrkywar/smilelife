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

                onModalCloseClick: function (element) {
                    $('modal-container').innerHTML = "";
                },

                onTargetClick: function (element) {
                    var card = dojo.query(".selected");

                    if (1 !== card.length) {
                        this.showMessage(_('Invalid Card Selection'), "error");
                        dojo.query(".selected").removeClass("selected");
                    } else {

                        var data = {
                            card: card[0].dataset.id,
                            target: element.target.dataset.player
                        };
                        if ('takeCard' === this.actualState) {
                            this.debug('AM-OTC',data);
                            this.takeAction('playFromDiscard', data);
                        } else {
                            this.takeAction('playCard', data);
                        }
                    }
                }



            }
    );
});