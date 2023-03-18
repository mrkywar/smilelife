define([
    "dojo",
    "dojo/_base/declare",
], function (dojo, declare) {
    return declare(
            "smilelife.playerpanel",
            [],
            {
                constructor: function () {
                },
                
                displayPanels: function () {
                    var gamedatas = this.gamedatas;
                    
                    for (var playerId in gamedatas.player) {
                        var player = gamedatas.player[playerId];
                        player.id = playerId;
                        this.debug("PA : "+playerId+" : ",player);
                        
                        dojo.place(this.getPlayerPanelHtml(player), "player_board_"+player.id);
                        var handCounter = new ebg.counter();
                        handCounter.create("player_hand_counter_".concat(player.id));
                        handCounter.setValue(player.hand);
                        
                        var maxhandCounter = new ebg.counter();
                        maxhandCounter.create("player_maxhand_counter_".concat(player.id));
                        maxhandCounter.setValue(player.attributes.maxCards);
                        this.maxhandCounters[player.id] = maxhandCounter;
                    }
                },
                
                
                getPlayerPanelHtml: function (player) {
                    return `
                        <div class="counters" id="playerpanel_`+player.id+`">
                            <div class="playerhand_counter">
                                <span id="player_hand_counter_`+player.id+`"></span>
                                /
                                <span id="player_maxhand_counter_`+player.id+`"></span>
                            </div> 
                        </div>
                    `;
                    
                    
                }
                
                

            }
    );
});