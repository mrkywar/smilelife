define([
    'dojo',
    'dojo/_base/declare',
], function (dojo, declare) {
    return declare(
            'smilelife.notification.play',
            [
                //smilelife.state.draw
            ],
            {
                notif_turnpassNotification: function (notif) {
                    var card = notif.args.card;
                    var cardDest = "pile_" + card.pile + "_" + notif.args.playerId;
                    this.displayCard(card, cardDest, cardDest);
                },

                notif_playNotification: function (notif) {
                    var card = notif.args.card;

                    var cardDest = "pile_" + card.pile + "_" + notif.args.targetId;

                    this.discard = notif.args.discard;
                    this.updateDiscard();

                    if (parseInt(notif.args.playerId) === this.player_id) {
                        this.displayCard(card, cardDest, "myhand");
                        dojo.query(".selected").removeClass("selected");
                        this.myTable = notif.args.table;

                        $('more-container').innerHTML = "";
                        $('modal-container').innerHTML = "";
                    } else {
                        this.gamedatas.tables[notif.args.playerId] = notif.args.table;
                        this.displayCard(card, cardDest, "playerpanel_" + notif.args.targetId, true);
                    }

                    this.debug("pcn", card, notif.args);

                    //-- UPDATE Counters
                    if("discard" === notif.args.from){
                        this.discardCounter.setValue(this.discardCounter.getValue() - 1);
                    }else{
                        this.boardCounter[card.locationArg][card.pile].setValue(this.boardCounter[card.locationArg][card.pile].getValue() - 1);
                    }
//                    if ("discard" === card.location) {
//                        this.discardCounter.setValue(this.discardCounter.getValue() - 1);
//                    } else if (card.locationArg !== notif.args.targetId) {
//                        this.boardCounter[card.locationArg][card.pile].setValue(this.boardCounter[card.locationArg][card.pile].getValue() - 1);
//                    }
                    this.boardCounter[notif.args.targetId][card.pile].setValue(this.boardCounter[notif.args.targetId][card.pile].getValue() + 1);

                    //-- Job redisplay (to keep on the top)
                    if ("job" === card.pile && "studies" === card.categorie) {
                        var jobDest = "pile_job_" + notif.args.playerId;

                        if (parseInt(notif.args.playerId) === this.player_id) {
                            var cardJob = this.myTable.job;
                        } else {
                            var cardJob = this.gamedatas.tables[notif.args.playerId].job;
                        }
                        if (null !== cardJob) {
                            this.displayCard(cardJob, jobDest, jobDest);
                        }
                    }
                    if (typeof notif.args.level !== 'undefined') {
                        this.notif_studiesLevelUpdate(notif);
                    }
                    

                    this.discard = notif.args.discard;

                },
            }
    );
});