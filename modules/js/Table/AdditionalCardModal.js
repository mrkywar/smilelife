//-- MODALE : Declare All supported Type
const MODAL_TYPE_TARGET = "target";
const MODAL_TYPE_CARD = "card";

//-- MODALE : Modale Type
const MODAL_TITLE_TARGET = 'CHOOSE_PLAYER_TARGET';
const MODAL_TITLE_CHOICE_DISCARD = 'CHOOSE_ADDITIONAL_CARD_IN_DISCARD';

define([
    "dojo",
    "dojo/_base/declare",
], function (dojo, declare) {
    return declare(
            "smilelife.table.additionalCardModal",
            [],
            {
                constructor: function () {
                    this.playData = null;
                    this.forcedTarget = false;
                },

                openModal: function (modalTitle, choiceType, card, playerProperties, displayAllChoices) {
                    var id = this.generateModale(_(modalTitle));

                    switch (choiceType) {
                        case MODAL_TYPE_TARGET:
                            this.generateTargetStatSelection(playerProperties, card, id, displayAllChoices);
                            break;
                        default:
                            this.showMessage(_('Unsupported call : ') + choiceType, "error");
                            break;
                    }
                },

                generateCardSelection: function (selectableCards, card, id) {
                    for (var hCardKey in selectableCards) {
                        var hCard = selectableCards[hCardKey];
                        hCard.idPrefix = "more_";

                        dojo.place(this.format_block('jstpl_visible_card', hCard), 'modal-selection-' + id);
                        var searchedDiv = document.getElementById('card_more_' + hCard.id)
                        var _this = this;

                        searchedDiv.addEventListener('click', (function (playedCard, additionalCard) {
                            return function () {
                                _this.onMoreClick(playedCard, additionalCard);
                            };
                        })(card, hCard));

                    }
                },

                getPropertyValue: function (table, property) {
                    if (typeof table[property] === "undefined") {
                        return null;
                    } else if (Array.isArray(table[property])) {

                        if (table[property].length > 0) {
                            var index = table[property].length - 1;
                            return table[property][index];
                        } else {
                            return null;
                        }
                    } else {
                        return table[property];
                    }
                },

                generateTargetSelectionCard: function (card, player) {
                    if (null !== card) {
                        card.idPrefix = "more_";
                        dojo.place(this.format_block('jstpl_visible_card', card), 'target_card_' + player.id);

                    }
                },

                generateTagetSelection: function (id) {
                    for (var playerId in this.gamedatas.tables) {
                        var player = this.gamedatas.tables[playerId].player;

                        dojo.place(this.getAttackBtnHtml(player), 'target-selection-' + id);
                        var targetDiv = document.getElementById("attack" + player.id + "_button");
                        var _this = this;

                        targetDiv.addEventListener('click', (function (targetedPlayer, id) {
                            return function () {
                                _this.onMoreTrocClick(targetedPlayer, id);
                            };
                        })(player, id));

                    }
                },

                generatePlayerStat: function (player, card, id) {
                    var tplData = {};

                    if (this.getHtmlColorLuma(player.color) > 100) {
                        textColor = "black";
                    } else {
                        textColor = "white";
                    }
                    tplData.targetId = player.id;
                    tplData.targetColor = player.color;
                    tplData.textColor = textColor;
                    tplData.targetName = player.name;

                    tplData.targetStudiesLevel = this.studyCounters[player.id].getValue();
                    tplData.targetWagesLevel = this.wagesCounters[player.id].getValue();
                    tplData.targetAviableWagesLevel = this.aviableWagesCounters[player.id].getValue();

                    dojo.place(this.format_block('jstpl_target_with_card', tplData), 'modal-selection-' + id);

                    var targetDiv = $("target_" + player.id);
                    var _this = this;

                    targetDiv.addEventListener('click', (function (targetedPlayer, playedCard) {
                        return function () {
                            _this.onTargetClick(targetedPlayer, playedCard);
                        };
                    })(player, card));
                },

                generateTargetStatSelection: function (properties, card, id, displayAll) {
                    var haveChoice = false;
                    for (var playerId in this.gamedatas.tables) {
                        var table = this.gamedatas.tables[playerId];
                        var player = table.player;

                        this.generatePlayerStat(player, card, id);

                        if (Array.isArray(properties)) {
                            for (var kProperty in properties) {
                                var property = properties[kProperty];

                                var pCard = this.getPropertyValue(table, property);

                                this.generateTargetSelectionCard(pCard, player);
                            }
                        } else {
                            var pCard = this.getPropertyValue(table, properties);
                            this.generateTargetSelectionCard(pCard, player);
                        }

                        var choices = dojo.query('#target_card_' + player.id + ' .cardontable');

                        if (0 === choices.length && !displayAll) {
                            dojo.destroy('target_' + player.id);
                        } else {
                            haveChoice = true;
                        }
                    }
                    if (!haveChoice) {
                        this.showMessage(_('No target aviable now'), "error");
                        dojo.destroy("modal_" + id);

                    }
                },

                additionalTrocCardModal: function (card) {
                    var id = this.generateModale(_('CHOOSE_ADDITIONAL_CARD_IN_HAND'));

                    var selectableCards = [];
                    for (var hCardKey in this.myHand) {
                        var hCard = this.myHand[hCardKey];
                        if (hCard.id != card.dataset.id) {
                            selectableCards.push(hCard);
                        }
                    }
                    this.forcedTarget = true;
                    this.generateCardSelection(selectableCards, card, id);

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

                            if ('discard' === card.dataset.location) {
                                this.takeAction('playFromDiscard', data);
                            } else {
                                this.takeAction('playCard', data);
                            }
                            this.forcedTarget = false;
                            return;
                        }
                    }
                    this.showMessage(_('No Bandit in game'), "error");

                },

                generateModale: function (title) {
                    var id = this.generateUniqueId();
                    dojo.place(this.format_block('jstpl_modal_v2', {'title': title, 'id': id}), 'more-container');
                    dojo.connect($("more_cancel_button_" + id), 'onclick', this, 'onModalCancelClick');
                    return id;
                },

//                gradeRepetitionModal: function (card) {
//                    var id = this.generateModale();
//
//                    this.generateTargetStatSelection(['studiesOnly', 'job'], card, id, false);
//                },

                jobAttackModal: function (card) {
                    var id = this.generateModale();

                    this.generateTargetStatSelection('job', card, id, true);
                },

                otherAttackModal: function (card) {
                    var id = this.generateModale();

                    this.generateTargetStatSelection('job', card, id, false);

                },

//                divorceModal: function (card) {
//                    var id = this.generateModale();
//
//                    this.generateTargetStatSelection(['marriage', 'job'], card, id, false);
//                },

//                incomeTaxModal: function (card) {
//                    var id = this.generateModale();
//
//                    this.generateTargetStatSelection(['wages', 'job'], card, id, false);
//                },

                astronautModal: function (card) {
                    var id = this.generateModale(_('CHOOSE_ADDITIONAL_CARD_IN_DISCARD'));

                    if (0 === this.discard.length) {
                        dojo.place(`<h3>` + _('No eligible cards, play the card anyway') + `</h3>`, 'modal-selection-' + id);
                    } else {
                        this.generateCardSelection(this.discard, card, id);
                    }
                    dojo.place(this.format_block('jstpl_btn_nobonus', {'id': id}), 'modal-btn-' + id);
                    dojo.connect($("more_valid_button_" + id), 'onclick', this, 'onModalValidClick');
                },

                shootingStarModal: function (card) {
                    if (0 === this.discard.length) {
                        this.showMessage(_('No discarded card'), "error");
                    } else {
                        var id = this.generateModale(_('CHOOSE_ADDITIONAL_CARD_IN_DISCARD'));
                        this.generateCardSelection(this.discard, card, id);
                    }
                },

//                trocModal: function (card) {
//                    var id = this.generateModale();
//                    this.generateTargetStatSelection(null, card, id, true);
//                },

                onModalValidClick: function () {
                    var playedCard = dojo.query("#game_container .selected");
//                    var additionalCard = dojo.query("#more-container .selected");

                    var data = {
                        card: playedCard[0].dataset.id
                    }

                    if ('discard' === playedCard[0].dataset.location) {
                        this.takeAction('playFromDiscard', data);
                    } else {
                        this.takeAction('playCard', data);
                    }
                    this.forcedTarget = false;
                },

                onMoreTrocClick: function (player, id) {
                    this.debug(this.playData, player, id);

                    var data = this.playData;
                    data.target = player.id;
                    this.takeAction('playCard', data);
                },

                onMoreClick: function (playedCard, additionalCard) {
                    var searchedDiv = $('card_more_' + additionalCard.id);
                    var targetChoice = dojo.query('#target-selection .action-button');

                    if (!searchedDiv.classList.contains("selected")) {
                        dojo.query("#more-container .selected").removeClass("selected");
                        searchedDiv.classList.add("selected");
                    } else if (this.forcedTarget) {
                        this.playData = {
                            additionalCards: [additionalCard.id],
                            card: playedCard.dataset.id
                        };
                        var id = this.generateModale();
                        this.generateTagetSelection(id);
                    } else if (0 === targetChoice.length) {

                        this.playData = {
                            additionalCards: [searchedDiv.dataset.id],
                            card: playedCard.dataset.id
                        };
                        if ('discard' === playedCard.dataset.location) {
                            this.cardPlay(searchedDiv, 'playFromDiscard');
                        } else {
                            this.cardPlay(searchedDiv, 'playCard');
                        }
                    }

                    return false;
                },

                onModalCancelClick: function (event) {
                    dojo.destroy("modal_" + event.target.dataset.modal);

                    this.playData = null;
                },

                onTargetClick: function (player, card) {
                    var aviableCard = dojo.query("#target_card_" + player.id + " .cardontable");
                    var selectedCard = dojo.query("#target_card_" + player.id + " .selected");

                    this.debug(aviableCard);

                    if (0 !== selectedCard.length || 0 === aviableCard.length) {

                        this.debug(this.playData);
                        var data = this.playData;
                        if (null === data) {
                            data = {
                                target: player.id,
                                card: card.dataset.id
                            };
                            if ('discard' === card.dataset.location) {
                                this.takeAction('playFromDiscard', data);
                            } else {
                                this.takeAction('playCard', data);
                            }
                        } else {
                            data.target = player.id;
                            this.takeAction('playCard', data);
                        }
                        this.forcedTarget = false;


                    } else {
                        dojo.query("#more-container .selected").removeClass("selected");
                        aviableCard.forEach(function (element) {
                            dojo.addClass(element, "selected");
                        });

                    }
                },

                onMoreTargetClick: function (player, card) {
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

                        if ('discard' === card.dataset.location) {
                            this.takeAction('playFromDiscard', data);
                        } else {
                            this.takeAction('playCard', data);
                        }
                        this.forcedTarget = false;
                    }
                }

            }
    );
});