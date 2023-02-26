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

                        dojo.place(this.displayTable(player), 'tables');
                    }

                    for (var playerId in gamedatas.tables) {
                        var table = gamedatas.tables[playerId];

                        //-- Display all cards on table
                        if(null !== table.job){
                            dojo.place(this.displayCard(table.job), 'playertable_' + playerId);
                        }
                        if(null !== table.marriage){
                            dojo.place(this.displayCard(table.marriage), 'playertable_' + playerId);
                        }
                        if(null !== table.adultery){
                            dojo.place(this.displayCard(table.adultery), 'playertable_' + playerId);
                        }
                        for (var acquisitionId in table.acquisitions) {
                            var acquisition = table.acquisitions[acquisitionId];
                            dojo.place(this.displayCard(acquisition), 'playertable_' + playerId);
                        }
                        for (var attackId in table.attacks) {
                            var attack = table.attacks[attackId];
                            dojo.place(this.displayCard(attack), 'playertable_' + playerId);
                        }
                        for (var studyId in table.studies) {
                            var study = table.studies[studyId];
                            dojo.place(this.displayCard(study), 'playertable_' + playerId);
                        }
                        for (var petId in table.pets) {
                            var pet = table.pets[petId];
                            dojo.place(this.displayCard(pet), 'playertable_' + playerId);
                        }
                        for (var childId in table.childs) {
                            var child = table.childs[childId];
                            dojo.place(this.displayCard(child), 'playertable_' + playerId);
                        }
                        for (var flirtId in table.flirts) {
                            var flirt = table.flirts[flirtId];
                            dojo.place(this.displayCard(flirt), 'playertable_' + playerId);
                        }
                        for (var wageId in table.wages) {
                            var wage = table.wages[wageId];
                            dojo.place(this.displayCard(wage), 'playertable_' + playerId);
                        }
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
