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
//                    this.debug('smilelife.DisplayTableTrait constructor');
//                    this.handCards = [];
                },

                displayTables: function (gamedatas) {
//                    this.debug(gamedatas);
                    //Prepare My table Container
                    var meAsPlayer = gamedatas.players[this.player_id];
                    meAsPlayer.id = this.player_id
                    dojo.place(this.getMyTableHtml(meAsPlayer), "tables");
                    //display player's table cards
                    this.displayTableCards(gamedatas.mytable, meAsPlayer);
                    
                    this.myTable = gamedatas.mytable;

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
//                    this.debug(player);
                    //----- Job & Studies
                    var count_job = 0;
                    if (null !== table.job) {
                        dojo.place(this.displayCard(table.job), 'pile_job_' + player.id);
                        count_job++;
                    } else if (table.studies.length > 0) {
                        var lastStudy = table.studies[table.studies.length - 1];
                        dojo.place(this.displayCard(lastStudy), 'pile_job_' + player.id);
                    }
                    count_job = count_job + table.studies.length;
                    $('pile_job_count_' + player.id).innerHTML = count_job;

                    //----- Wages
                    if (table.wages.length > 0) {
                        var lastWage = table.wages[table.wages.length - 1];
                        dojo.place(this.displayCard(lastWage), 'pile_wage_' + player.id);
                    }
                    $('pile_wage_count_' + player.id).innerHTML = table.wages.length;

                    //----- Flirts & Marriage
                    var count_love = 0;
                    if (null !== table.marriage) {
                        dojo.place(this.displayCard(table.marriage), 'pile_love_' + player.id);
                        count_love++;
                    } else if (table.flirts.length > 0) {
                        var lastFlirt = table.flirts[table.flirts.length - 1];
                        dojo.place(this.displayCard(lastFlirt), 'pile_love_' + player.id);
                    }
                    count_love = count_love + table.flirts.length;
                    $('pile_love_count_' + player.id).innerHTML = count_love;

                    //----- Childs
                    if (table.childs.length > 0) {
                        var lastChild = table.childs[table.childs.length - 1];
                        dojo.place(this.displayCard(lastChild), 'pile_child_' + player.id);
                    }
                    $('pile_child_count_' + player.id).innerHTML = table.childs.length;

                    //----- Attacks
                    if (table.attacks.length > 0) {
                        var lastAttack = table.attacks[table.attacks.length - 1];
                        dojo.place(this.displayCard(lastAttack), 'pile_attack_' + player.id);
                    }
                    $('pile_attack_count_' + player.id).innerHTML = table.attacks.length;


                    //----- Pet House & Travel (pet in first)
                    if (table.pets.length > 0) {
                        var lastPet = table.pets[table.pets.length - 1];
                        dojo.place(this.displayCard(lastPet), 'pile_aquisition_' + player.id);
                    } else if (table.acquisitions.length > 0) {
                        var lastAquisition = table.acquisitions[table.acquisitions.length - 1];
                        dojo.place(this.displayCard(lastAquisition), 'pile_aquisition_' + player.id);
                    }
                    $('pile_aquisition_count_' + player.id).innerHTML = table.pets.length + table.acquisitions.length;

                    //----- Adultery
                    if (null !== table.adultery) {
                        dojo.place(this.displayCard(table.adultery), 'pile_bonus1_' + player.id);
                        $('pile_bonus1_count_' + player.id).innerHTML = 1;
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
                        
                    ` + this.getTableHtml(player);

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

                        <div class="pile_container pile_attack">
                            <div class="pile_info">{Malus}</div>
                            <div class="pile" id="pile_attack_` + player.id + `">
                                
                            </div>
                            <div class="pile_counter" id="pile_attack_count_` + player.id + `">0</div>
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
                            <div class="pile_counter" id="pile_child_count_` + player.id + `">0</div>
                        </div>
                    
                        <div class="pile_container pile_bonus">
                            <div class="pile_info">&nbsp;</div>
                            <div class="pile" id="pile_bonus1_` + player.id + `">
                            </div>
                            <div class="pile_counter" id="pile_bonus1_count_` + player.id + `"></div>
                        </div>
                        
                        <div class="pile_containe pile_bonus">
                            <div class="pile_info">&nbsp;</div>
                            <div class="pile" id="pile_bonus2_` + player.id + `">
                            </div>
                            <div class="pile_counter" id="pile_bonus2_count_` + player.id + `"></div>
                        </div>
                    `;
                },

            }

    );
});
