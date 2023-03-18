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
                        
                    }
                    
                    
                    
//                     var playerId = Number(player.id);
//            // show end game points
//            dojo.place("<span class=\"end-game-points\">&nbsp;/&nbsp;".concat(POINTS_FOR_PLAYERS[Object.keys(gamedatas.players).length], "</span>"), "player_score_".concat(playerId), 'after');
//            // hand cards counter
//            dojo.place("<div class=\"counters\">\n                <div id=\"playerhand-counter-wrapper-".concat(player.id, "\" class=\"playerhand-counter\">\n                    <div class=\"player-hand-card\"></div> \n                    <span id=\"playerhand-counter-").concat(player.id, "\"></span>\n                </div>\n            </div>"), "player_board_".concat(player.id));
//            var handCounter = new ebg.counter();
//            handCounter.create("playerhand-counter-".concat(playerId));
//            handCounter.setValue(player.handCards.length);
//            _this.handCounters[playerId] = handCounter;
                },
                
                
                getPlayerPanelHtml: function (player) {
                    return `
                        <div class="counters" id="playerpanel_`+player.id+`">
                            <div class="playerhand-counter">
                                <span id="playerhand-counter-wrapper-`+player.id+`"></span>
                                /
                                <span id="maxhand-counter-wrapper-`+player.id+`"></span>
                            </div> 
                        </div>
                    `;
                    
                    
                }
                
                

            }
    );
});