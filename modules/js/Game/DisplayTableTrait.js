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
//                    this.debug('ici', this.player_id, );
                    //Prepare My table Container
                    dojo.place(this.getMyTableHtml(gamedatas.players[this.player_id]), "tables");
                    //display player's table cards
                    this.displayTableCards(gamedatas.mytable, "mytable");
//                    dojo.place(this.getTableHtml(gamedatas.players[this.player_id]), 'mytable');
//                    this.displayTableCards(gamedatas.mytable, 'playertable_' + playerId);

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

                getMyTableHtml: function (player) {
                    var textColor = "";
                    if (this.getHtmlColorLuma(player.color) > 100) {
                        textColor = "black";
                    } else {
                        textColor = "white";
                    }

                    return`
                        <div id="myhand_container" class="playertable whiteblock" style="border-color:#` + player.color + `;">
                            <div class="playertablename" style="background-color:#` + player.color + `;color:` + textColor + `">My Hand</div>
                            <div id="myhand" class="playertablecard">

                            </div>
                        </div>
                        <div id="mytable_container" class="playertable whiteblock" style="border-color:#` + player.color + `;">
                            <div class="playertablename" style="background-color:#` + player.color + `;color:` + textColor + `">` + player.name + `</div>
                            <div id="mytable" class="playertablecard">

                            </div>
                        </div>
                    `;

                },

                getTableHtml: function (player) {
                    var textColor = "";
                    if (this.getHtmlColorLuma(player.color) > 100) {
                        textColor = "black";
                    } else {
                        textColor = "white";
                    }

                    return `
                        <div class="playertable whiteblock" id="player_board_` + player.id + `" style="border-color:#` + player.color + `" >
                            <div class="playertablename" style="background:#` + player.color + `;color:` + textColor + `">` + player.name + `</div>
                            <div class="playertablecard" id="playertable_` + player.id + `">
                            </div>
                            <div class="clear"></div>
                        </div>
                    `;

                }


            }

    );
});
