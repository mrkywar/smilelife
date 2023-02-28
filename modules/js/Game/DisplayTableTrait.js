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

                displayMyTable: function (gamedatas) {

                },

                displayTables: function (gamedatas) {
                    this.debug(gamedatas);
                    
                    //-display player's table cards
                    this.displayTableCards(gamedatas.mytable, "mytable");

                    for (var playerId in gamedatas.tables) {
                        var player = gamedatas.players[playerId];
                        player.id = playerId;

                        dojo.place(this.getTableHtml(player), 'tables');
                        
                        var table = gamedatas.tables[playerId];
                        
                        //-display openents's table cards
                        this.displayTableCards(table, 'playertable_' + playerId);

                    }

                },

                displayTableCards: function (table, target) {
                    if (null !== table.job) {
                        dojo.place(this.displayCard(table.job), target);
                    }
                    if (null !== table.marriage) {
                        dojo.place(this.displayCard(table.marriage), target);
                    }
                    if (null !== table.adultery) {
                        dojo.place(this.displayCard(table.adultery), target);
                    }
                    for (var acquisitionId in table.acquisitions) {
                        var acquisition = table.acquisitions[acquisitionId];
                        dojo.place(this.displayCard(acquisition), target);
                    }
                    for (var attackId in table.attacks) {
                        var attack = table.attacks[attackId];
                        dojo.place(this.displayCard(attack), target);
                    }
                    for (var studyId in table.studies) {
                        var study = table.studies[studyId];
                        dojo.place(this.displayCard(study), target);
                    }
                    for (var petId in table.pets) {
                        var pet = table.pets[petId];
                        dojo.place(this.displayCard(pet), target);
                    }
                    for (var childId in table.childs) {
                        var child = table.childs[childId];
                        dojo.place(this.displayCard(child), target);
                    }
                    for (var flirtId in table.flirts) {
                        var flirt = table.flirts[flirtId];
                        dojo.place(this.displayCard(flirt), target);
                    }
                    for (var wageId in table.wages) {
                        var wage = table.wages[wageId];
                        dojo.place(this.displayCard(wage), target);
                    }
                },

                displayMyTable: function (gamedatas) {
                    var table = gamedatas.mytable;

                    //-- Display all cards on table

                },

                getTableHtml: function (player) {
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
