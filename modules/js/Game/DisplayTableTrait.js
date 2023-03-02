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
                    var meAsPlayer = gamedatas.players[this.player_id];
                    meAsPlayer.id = this.player_id
                    dojo.place(this.getMyTableHtml(meAsPlayer), "tables");
                    //display player's table cards
//                    this.displayTableCards(gamedatas.mytable, "mytable");
//                    dojo.place(this.getTableHtml(gamedatas.players[this.player_id]), 'mytable');
//                    this.displayTableCards(gamedatas.mytable, 'playertable_' + playerId);

                    for (var playerId in gamedatas.tables) {
                        var player = gamedatas.players[playerId];
                        player.id = playerId;

                        dojo.place(this.getTableHtml(player), 'tables');

                        var table = gamedatas.tables[playerId];

                        //-display openents's table cards
                        this.displayTableCards(table, player);

                    }

                },

                displayTableCards: function (table, player) {
                    if (null !== table.job) {
                        dojo.place(this.displayCard(table.job), 'playertable_' + player.id);
                    }
                    if (null !== table.marriage) {
                        dojo.place(this.displayCard(table.marriage), 'playertable_' + player.id);
                    }
                    if (null !== table.adultery) {
                        dojo.place(this.displayCard(table.adultery), 'playertable_' + player.id);
                    }
                    for (var acquisitionId in table.acquisitions) {
                        var acquisition = table.acquisitions[acquisitionId];
                        dojo.place(this.displayCard(acquisition), 'playertable_' + player.id);
                    }
                    for (var attackId in table.attacks) {
                        var attack = table.attacks[attackId];
                        dojo.place(this.displayCard(attack), 'playertable_' + player.id);
                    }
                    for (var studyId in table.studies) {
                        var study = table.studies[studyId];
                        dojo.place(this.displayCard(study), 'playertable_' + player.id);
                    }
                    for (var petId in table.pets) {
                        var pet = table.pets[petId];
                        dojo.place(this.displayCard(pet), 'playertable_' + player.id);
                    }
                    for (var childId in table.childs) {
                        var child = table.childs[childId];
                        dojo.place(this.displayCard(child), 'playertable_' + player.id);
                    }
                    for (var flirtId in table.flirts) {
                        var flirt = table.flirts[flirtId];
                        dojo.place(this.displayCard(flirt), 'playertable_' + player.id);
                    }
                    for (var wageId in table.wages) {
                        var wage = table.wages[wageId];
                        dojo.place(this.displayCard(wage), 'playertable_' + player.id);
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
                            <div class="playertablecard" id="playertable_` + player.color + `">
                                ` + this.getTableBoardHtml(player) + `
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
                                ` + this.getTableBoardHtml(player) + `
                            </div>
                            <div class="clear"></div>
                        </div>
                    `;

                },

                getTableBoardHtml: function (player) {
                    return `
                        <div class="pile_container pile_job">
                            <div class="pile_info">{Studies Job}</div>
                            <div class="pile" id="pile_job_` + player.id + `">
                                
                            </div>
                            <div class="pile_counter" id="pile_job_count_` + player.id + `">0</div>
                        </div>
                        
                        <div class="pile_container pile_love">
                            <div class="pile_info">{Flirts Marriage}</div>
                            <div class="pile" id="pile_love_` + player.id + `">
                                
                            </div>
                            <div class="pile_counter" id="pile_love_count_` + player.id + `">0</div>
                        </div>

                        <div class="pile_container pile_aquisition">
                            <div class="pile_info">{Pets Travels House}</div>
                            <div class="pile" id="pile_aquisition_` + player.id + `">
                                
                            </div>
                            <div class="pile_counter" id="pile_aquisition_count_` + player.id + `">0</div>
                        </div>

                        <div class="pile_container pile_malus">
                            <div class="pile_info">{Malus}</div>
                            <div class="pile" id="pile_malus_` + player.id + `">
                                
                            </div>
                            <div class="pile_counter" id="pile_malus_count_` + player.id + `">0</div>
                        </div>
                    
                        <div class="pile_container pile_wage">
                            <div class="pile_info">{Wages}</div>
                            <div class="pile" id="pile_wage_` + player.id + `">
                                
                            </div>
                            <div class="pile_counter" id="pile_wage_count_` + player.id + `">0</div>
                        </div>
                    
                        <div class="pile_container pile_child">
                            <div class="pile_info">{Childs}</div>
                            <div class="pile" id="pile_child_` + player.id + `">
                                
                            </div>
                            <div class="pile_counter" id="pile_wage_count_` + player.id + `">0</div>
                        </div>
                    
                        <div class="pile_container pile_bonus">
                            <div class="pile_info"></div>
                            <div class="pile" id="pile_bonus1_` + player.id + `">
                            </div>
                            <div class="pile_counter" id="pile_bonus1_count_` + player.id + `"></div>
                        </div>
                        
                        <div class="pile_containe pile_bonus">
                            <div class="pile_info"></div>
                            <div class="pile" id="pile_bonus2_` + player.id + `">
                            </div>
                            <div class="pile_counter" id="pile_bonus2_count_` + player.id + `"></div>
                        </div>
                    `;
                },

            }

    );
});
