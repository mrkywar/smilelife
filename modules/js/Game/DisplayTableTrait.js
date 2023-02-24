define([
    'dojo',
    'dojo/_base/declare',
    'ebg/core/gamegui',
    g_gamethemeurl + 'modules/js/Core/ToolsTrait.js'
], function (dojo, declare) {
    return declare(
            'smilelife.DisplayTableTrait',
            [
                common.ToolsTrait
            ],
            {

                constructor: function () {
                    this.debug('smilelife.DisplayTableTrait constructor');
//                    this.handCards = [];
                },

                displayTables: function (gamedatas) {
                    this.debug(gamedatas);
                    for (var playerId in gamedatas.players) {
//                        this.debug(playerId, gamedatas.players[playerId]);
                        var player = gamedatas.players[playerId];
                        player.id = playerId;

                        dojo.place(this.displayTable(player), 'board');
                    }


                },

                displayTable: function (player) {
                    return `
                        <div  class="playertable whiteblock playertable" id="player_board_` + player.id + `" >
                            <div class="playertablename" style="color:#` + player.color + `">` + player.name + `</div>
                            <div class="playertablecard" id="playertable_` + player.id + `">
                            </div>
                            <div class="clear"></div>
                        </div>
                    `;
                }


            }

    );
});
