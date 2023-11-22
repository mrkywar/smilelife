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
//                    this.debug("notif", cardDest, card);
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

                    if (notif.args.fromHand) {
                        this.handCounters[notif.args.playerId].setValue(this.handCounters[notif.args.playerId].getValue() - 1);
                    } else {
                        this.discardCounter.setValue(this.discardCounter.getValue() - 1);
                    }

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

                    this.boardCounter[notif.args.targetId][notif.args.card.pile].setValue(this.boardCounter[notif.args.targetId][notif.args.card.pile].getValue() + 1);

                    this.discard = notif.args.discard;

                },
            }
    );
});