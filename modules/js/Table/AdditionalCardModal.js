define([
    "dojo",
    "dojo/_base/declare",
], function (dojo, declare) {
    return declare(
            "smilelife.table.additionalCardModal",
            [],
            {
                constructor: function () {

                },

                generateCardSelection(selectableCards, card) {
                    for (var hCardKey in selectableCards) {
                        var hCard = selectableCards[hCardKey];

                        dojo.place(this.format_block('jstpl_card_more', hCard), 'modal-selection');
                        var searchedDiv = document.getElementById('card_more_' + hCard.id)
                        var _this = this;

                        searchedDiv.addEventListener('click', (function (playedCard, additionalCard) {
                            return function () {
                                _this.onMoreClick(playedCard, additionalCard);
                            };
                        })(card, hCard));

                    }
                },

                additionalTrocCardModal: function (card) {
                    dojo.place(this.format_block('jstpl_modal_v2', {'title': "CHOOSE_ADDITIONAL_CARD_IN_HAND"}), 'more-container');
                    dojo.connect($("more_cancel_button"), 'onclick', this, 'onModalCancelClick');

                    var selectableCards = [];
                    for (var hCardKey in this.myHand) {
                        var hCard = this.myHand[hCardKey];
                        if (hCard.id != card.dataset.id) {
                            selectableCards.push(hCard);
                        }
                    }
                    this.generateCardSelection(selectableCards, card);

                    for (var playerId in this.gamedatas.tables) {
                        var player = this.gamedatas.tables[playerId].player;

                        dojo.place(this.getAttackBtnHtml(player), 'target-selection');
                        var targetDiv = document.getElementById("attack" + player.id + "_button");
                        var _this = this;

                        targetDiv.addEventListener('click', (function (targetedPlayer) {
                            return function () {
                                _this.onMoreTargetClick(targetedPlayer);
                            };
                        })(player));

                    }

                    dojo.connect($("additionalCancel_button"), 'onclick', this, 'onModalCloseClick');
                },

                jailModal: function (card) {
                    for (var playerId in this.gamedatas.tables) {
                        var job = this.gamedatas.tables[playerId].job;

                        if (null !== job && job.type == CARD_TYPE_BANDIT) {
                            var data = {
                                target: playerId,
                                card: card.dataset.id,
                            };

                            this.takeAction('playCard', data);
                            return;
                        }
                    }
                    this.showMessage(_('No Bandit in game'), "error");

                },

                dissmissalModal: function (card) {
                    dojo.place(this.format_block('jstpl_modal_v2', {'title': "CHOOSE_PLAYER_TARGET"}), 'more-container');
                    dojo.connect($("more_cancel_button"), 'onclick', this, 'onModalCancelClick');

                    var haveTarget = false;
                    for (var playerId in this.gamedatas.tables) {
                        var table = this.gamedatas.tables[playerId];
                        var player = table.player;
                        var job = table.job;

                        if (null !== job) {
                            haveTarget = true;
                            var tplData = job;

                            if (this.getHtmlColorLuma(player.color) > 100) {
                                textColor = "black";
                            } else {
                                textColor = "white";
                            }
                            tplData.targetId = playerId;
                            tplData.targetColor = player.color;
                            tplData.textColor = textColor;
                            tplData.targetName = player.name;

                            tplData.targetStudiesLevel = this.studyCounters[playerId].getValue();
                            tplData.targetWagesLevel = this.wagesCounters[playerId].getValue();

                            dojo.place(this.format_block('jstpl_target_with_card', tplData), 'modal-selection');

                            var targetDiv = document.getElementById("taget_" + playerId);
                            var _this = this;

                            targetDiv.addEventListener('click', (function (targetedPlayer, card) {
                                return function () {
                                    _this.onTargetClick(targetedPlayer, card);
                                };
                            })(player, job));

                        }

                    }
                    if (!haveTarget) {
                        this.showMessage(_('No job in game'), "error");
                        this.onModalCancelClick();
                    }
                },

                astronautModal: function (card) {
                    dojo.place(this.format_block('jstpl_modal_v2', {'title': _('choose a card')}), 'more-container');
                    dojo.connect($("more_cancel_button"), 'onclick', this, 'onModalCancelClick');

                    this.debug(this.discard);
                    if (0 === this.discard.length) {
                        dojo.place(this.format_block('jstpl_btn_valid'), 'modal-btn');
                        dojo.place(`<h3>` + _('No eligible cards, play the card anyway') + `</h3>`, 'modal-selection');
                        dojo.connect($("more_valid_button"), 'onclick', this, 'onModalValidClick');
                    } else {

                        this.generateCardSelection(this.discard, card);
                    }

                },

                onModalValidClick: function () {
                    var playedCard = dojo.query("#game_container .selected");
//                    var additionalCard = dojo.query("#more-container .selected");

                    var data = {
                        card: playedCard[0].dataset.id
                    }

                    this.debug(data);
                    this.takeAction('playCard', data);
                },


                onMoreClick: function (playedCard, additionalCard) {
                    var searchedDiv = $('card_more_' + additionalCard.id);
                    var targetChoice = dojo.query('#target-selection .action-button');

                    if (!searchedDiv.classList.contains("selected")) {
                        dojo.query("#more-container .selected").removeClass("selected");
                        searchedDiv.classList.add("selected");
                    } else if (0 === targetChoice.length) {
                        var data = {
                            additionalCards: [searchedDiv.dataset.id],
                            card: playedCard.dataset.id
                        };

                        this.takeAction('playCard', data);
                    }

                    return false;
                },

                onModalCancelClick: function () {
                    $('more-container').innerHTML = "";
                },

                onTargetClick: function (player, card) {
                    var searchedDiv = $('card_more_' + card.id);
                    var playedCard = dojo.query("#game_container .selected");

                    if (!searchedDiv.classList.contains("selected")) {
                        dojo.query("#more-container .selected").removeClass("selected");
                        searchedDiv.classList.add("selected");
                        return;
                    } else {
                        var data = {
                            target: player.id,
                            card: playedCard[0].dataset.id,
                        };

                        this.takeAction('playCard', data);
                    }
                },

                onMoreTargetClick: function (player) {
                    var playedCard = dojo.query("#game_container .selected");
                    var additionalCard = dojo.query("#more-container .selected");

                    if (1 !== additionalCard.length || 1 !== playedCard.length) {
                        this.showMessage(_('Invalid Card Selection'), "error");
                        dojo.query("#more-container .selected").removeClass("selected");
                    } else {
                        var data = {
                            target: player.id,
                            card: playedCard[0].dataset.id,
                            additionalCards: [additionalCard[0].dataset.id]
                        };

                        this.takeAction('playCard', data);
                    }
                }

            }
    );
});