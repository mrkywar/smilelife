define([
    "dojo",
    "dojo/_base/declare",

    g_gamethemeurl + 'modules/js/Table/TablePile.js',
], function (dojo, declare) {
    return declare(
            "smilelife.playertable",
            [
                smilelife.table.pile
            ],
            {
                constructor: function () {
                    this.myHand = [];
                    this.myTable = [];
                    this.luckCards = null;
                },

                /**
                 * This function is check if a given card is a job owned by 
                 * the active player
                 */
                isMyJob: function (card) {
                    return (
                            (undefined !== card.category) && //is card category defined
                            (card.category.includes("job")) && //is card a job ?
                            null !== this.myTable.job && //did I have a job 
                            card.id === this.myTable.job.id                     //is this card the same of my job
                            );
                },

                isMyJobPilot: function () {
                    return(
                            null !== this.myTable.job && //did I have a job 
                            this.myTable.job.type === CARD_TYPE_AIRLINE_PILOT
                            );
                },
                
                isMyJobAchitectUsable:function(){
                    this.debug(this.myTable.job);
                    return (
                                null !== this.myTable.job && //did I have a job 
                                this.myTable.job.type === CARD_TYPE_ARCHITECT
                            )
                },

                getUsableWages: function () {
                    var cards = [];
                    for (var cardIndex in this.myTable.wages) {
                        var wage = this.myTable.wages[cardIndex];
//                        this.debug('W',wage);
                        if (!wage.isFlipped) {
                            cards.push(wage);
                        }
                    }
                    return cards;
                },

                getAviableAmount: function (wages) {
                    if (typeof wages === "undefined") {
                        wages = this.getUsableWages();
                    }

                    var amount = 0;
                    this.debug(wages);
                    for (var kWage in wages) {
                        var hWage = wages[kWage];
                        amount+= hWage.wageAmount;
                        this.debug("w",hWage);
                    }
                    return amount;
                },
                /**
                 * This function is check if a given card is a marriage owned by 
                 * the active player
                 */
                isMyMarriage: function (card) {
                    return (
                            (undefined !== card.category) && //is card category defined
                            (card.category.includes("marriage")) && //is card a marriage ?
                            null !== this.myTable.marriage && //did I have a marriage 
                            card.id === this.myTable.marriage.id                //is this card the same of my marriage
                            );
                },
                
                getMyMarriage: function(){
                    return this.myTable.marriage;
                },

                /**
                 * This function is the main code for displaying all Tables for 
                 * dispaying my Hand, my Table and oppponents' tables
                 */
                displayTables: function () {
                    var gamedatas = this.gamedatas;

                    this.myTable = gamedatas.mytable;

                    //Prepare & display this player table Container
                    var meAsPlayer = gamedatas.players[this.player_id];
                    meAsPlayer.id = this.player_id

                    dojo.place(this.getMyTableHtml(meAsPlayer), "tables");

                    //Prepare & Display this player Hand Cards
                    this.myHand = gamedatas.myhand;
                    this.displayMyHand();

                    //Display this player Table cards
                    this.displayTablePiles(gamedatas.mytable);

                    //Save special Cards
                    this.luckCards = gamedatas.luckCards;

                    //Display of opponents' game tables
                    for (var playerId in gamedatas.tables) {
                        var table = gamedatas.tables[playerId];
                        var player = table.player;
                        player.id = playerId;
                        dojo.place(this.getTableHtml(player), 'tables'); //table container

                        var table = gamedatas.tables[playerId];
                        this.displayTablePiles(table);
                    }
                },

                displayMyHand: function () {
                    var myhand = $('myhand');
                    myhand.innerHTML = ``;
                    for (var cardId in this.myHand) {
                        var card = this.myHand[cardId];
                        this.displayCard(card, "myhand");
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
                        <div class="playertable whiteblock" id="playertable_container_` + player.id + `" style="border-color:#` + player.color + `" >
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

                        <div class="pile_container pile_acquisition">
                            <div class="pile_info">{Pets Travels House}</div>
                            <div class="pile" id="pile_acquisition_` + player.id + `">
                                
                            </div>
                            <div class="pile_counter" id="pile_acquisition_count_` + player.id + `">0</div>
                        </div>

                        <div class="pile_container pile_attack">
                            <div class="pile_info">{Malus}</div>
                            <div class="pile" id="pile_attack_` + player.id + `">
                                
                            </div>
                            <div class="pile_counter" id="pile_attack_count_` + player.id + `">0</div>
                        </div>
                    
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
                    
                        <div class="pile_container pile_adultery">
                            <div class="pile_info">{Adultery}</div>
                            <div class="pile" id="pile_adultery_` + player.id + `">
                            </div>
                            <div class="pile_counter" id="pile_adultery_count_` + player.id + `">0</div>
                        </div>
                        
                        <div class="pile_container pile_special">
                            <div class="pile_info">{Rewards & Specials}</div>
                            <div class="pile" id="pile_special_` + player.id + `">
                            </div>
                            <div class="pile_counter" id="pile_special_count_` + player.id + `">0</div>
                        </div>
                    `;
                },

            }
    );
});
