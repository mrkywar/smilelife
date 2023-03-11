define([
    "dojo",
    "dojo/_base/declare",

    g_gamethemeurl + 'modules/js/Table/TablePile.js',
], function (dojo, declare) {
    return declare(
            "smilelife.table",
            [
                smilelife.table.pile
            ],
            {
                constructor: function () {
                    this.debug("smilelife.table constructor");


                },

                displayTables: function () {
                    var gamedatas = this.gamedatas;

                    this.myTable = gamedatas.mytable;

                    //Prepare & display this player table Container
                    var meAsPlayer = gamedatas.players[this.player_id];
                    meAsPlayer.id = this.player_id
                    dojo.place(this.getMyTableHtml(meAsPlayer), "tables");

                    //Prepare & Display this player Hand Cards
                    this.myHand = gamedatas.myhand;
                    for (var cardId in gamedatas.myhand) {
                        var card = gamedatas.myhand[cardId];
                        this.createMoveOrUpdateCard(card, "myhand");

//                        var card = gamedatas.myhand[cardId];
//                        dojo.place(this.displayCard(card), 'myhand');
//                        
//                        var cardBis = gamedatas.myhand[cardId];
//                        dojo.place(this.displayCard(cardBis), 'myhand');
                    }


                    //Display of opponents' game tables
                    this.otherTabes = gamedatas.tables;
                    for (var playerId in gamedatas.tables) {
                        var player = gamedatas.players[playerId];
                        player.id = playerId;
                        dojo.place(this.getTableHtml(player), 'tables'); //table container

                        var table = gamedatas.tables[playerId];
                    }


                    //Prepare & display my Tables Piles Content (last played cards)
                    this.myPiles = this.getTablePiles(this.myTable);





//                    this.debug(gamedatas);



//                    //display player's table cards
//                    this.displayTableCards(gamedatas.mytable, meAsPlayer);
//                    
//                    this.myTable = gamedatas.mytable;
//
//                    for (var playerId in gamedatas.tables) {
//                        var player = gamedatas.players[playerId];
//                        player.id = playerId;
//
//                        dojo.place(this.getTableHtml(player), 'tables');
//
//                        var table = gamedatas.tables[playerId];
//
//                        //-display openents's table cards
//                        this.displayTableCards(table, player);
//
//                    }

                },

                /**
                 * This function get all piles content for a given Table
                 * @param {object} table
                 * @returns {String}
                 */
                getTablePiles: function (table) {
                    var professionalPile = table.studies;
                    if (null !== table.job) {
                        professionalPile.push(table.job);
                    }

                    var lovePile = table.flirts;
                    if (null !== table.marriage) {
                        professionalPile.push(table.marriage);
                    }

                    return {
                        professionalPile: professionalPile,
                        lovePile: lovePile,
                        wagePile: table.wages,
                        childPile: table.childs,
                        attackPile: table.attacks,
                        acquisitionPile: table.acquisitions,
                        bonus1Pile: table.adultery,
                    }
                },

                /**
                 * This function get HTML code for connected player table (with hand container)
                 * @param {object} player
                 * @returns {String}
                 */
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

                /**
                 * This function get HTML table container code (include 
                 * connected) for the given player 
                 * @param {object} player
                 * @returns {String}
                 */
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

                /**
                 * This function get HTML of all table components code (include 
                 * connected) for the given player. the components should be in 
                 * a table container
                 * @param {object} player
                 * @returns {String}
                 */
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
