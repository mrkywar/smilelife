define([
    "dojo",
    "dojo/_base/declare",
], function (dojo, declare) {
    return declare(
            "smilelife.playerpanel",
            [],
            {
                constructor: function () {
                    this.handCounters = [];
                    this.maxhandCounters = [];
                    this.studyCounters = [];
                    this.wagesCounters = [];
                },

                displayPanels: function () {
                    var gamedatas = this.gamedatas;

                    //-- Display My Panel
                    this.displayAPanel(gamedatas.mytable.player);

                    //-- Display Opponent Panel
                    for (var playerId in gamedatas.tables) {
                        this.displayAPanel(gamedatas.tables[playerId].player);
                    }
                },

                displayAPanel: function (player) {
                    dojo.place(this.getPlayerPanelHtml(player), "player_board_" + player.id);
                    var handCounter = new ebg.counter();
                    handCounter.create("player_hand_counter_".concat(player.id));
                    handCounter.setValue(player.hand);
                    this.handCounters[player.id] = handCounter;

                    var maxhandCounter = new ebg.counter();
                    maxhandCounter.create("player_maxhand_counter_".concat(player.id));
                    maxhandCounter.setValue(player.attributes.maxCards);
                    this.maxhandCounters[player.id] = maxhandCounter;

                    var studyCounter = new ebg.counter();
                    studyCounter.create("player_studies_counter_".concat(player.id));
                    studyCounter.setValue(player.studies);
                    this.studyCounters[player.id] = studyCounter;

                    var wagesCounter = new ebg.counter();
                    wagesCounter.create("player_wages_counter_".concat(player.id));
                    wagesCounter.setValue(player.totalWages);
                    this.wagesCounters[player.id] = wagesCounter;
                },

                getPlayerPanelHtml: function (player) {
                    return `
                        <div class="player_counters" id="playerpanel_` + player.id + `">
                            <div class="player_conter_item playerhand_counter">
                                <span id="player_hand_counter_` + player.id + `"></span>
                                <span>/</span>
                                <span id="player_maxhand_counter_` + player.id + `"></span>
                            </div> 
                            <div class="player_conter_item playerstudies_counter">
                                <span id="player_studies_counter_` + player.id + `"></span>
                            </div>
                            <div class="player_conter_item playerwage_counter">
                                <span id="player_wages_aviable_counter_` + player.id + `"></span>
                                <span>/</span>
                                <span id="player_wages_counter_` + player.id + `"></span>
                            </div>
                        </div>
                    `;


                }



            }
    );
});