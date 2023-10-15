//-- MODALE : Declare All supported Type
const MODAL_TYPE_TARGET = "target";
const MODAL_TYPE_CARD = "card";
const MODAL_TYPE_DISPLAY = "display";
const MODAL_TYPE_DISPLAY_MULTI = "displayPlayer";
const MODAL_TYPE_TROC = "troc";

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

                openModal: function (modalTitle, choiceType, card, requiredProperties, optionnalProperties) {
                    switch (choiceType) {
                        case MODAL_TYPE_DISPLAY_MULTI:
                            var id = this.generateModale(modalTitle, "special-container");
                            for (var playerId in requiredProperties) {
                                var table = this.gamedatas.tables[playerId];
                                var player = table.player;
//                                var card = requiredProperties[playerId];
                                player.id = playerId;
                                dojo.place(this.format_block('jstpl_target_with_card', this.getPlayerStatsInfos(player, id)), 'modal-selection-' + id);
                                for (var hCardKey in requiredProperties[playerId]) {
                                    var hCard = requiredProperties[playerId][hCardKey];
                                    hCard.idPrefix = "more_";

                                    dojo.place(this.format_block('jstpl_visible_card', hCard), 'target_card_' + player.id);
                                }
                            }
                            $("more_cancel_button_" + id).innerHTML = _('ok');
                            break;
                        case MODAL_TYPE_DISPLAY :
                            var id = this.generateModale(modalTitle, "special-container");
                            this.generateCardSelection(requiredProperties, card, id);
                            $("more_cancel_button_" + id).innerHTML = _('ok');
                            break;
                        case MODAL_TYPE_TARGET:
                            var id = this.generateModale(modalTitle);
                            this.generateTargetStatSelection(requiredProperties, optionnalProperties, card, id);
                            return id;
                            break;
                        case MODAL_TYPE_CARD :
                            if (0 === requiredProperties.length) {
                                this.showMessage(_('No eligible cards'), "error");
                            } else {
                                var id = this.generateModale(modalTitle);
                                if (0 === requiredProperties.length) {
                                    dojo.place(`<h3>` + _('No eligible cards, play the card anyway') + `</h3>`, 'modal-selection-' + id);
                                } else {
                                    this.generateCardSelection(requiredProperties, card, id);
                                }

                                if (CARD_TYPE_SHOOTING_STAR !== parseInt(card.dataset.type)) {
                                    dojo.place(this.format_block('jstpl_btn_nobonus', {'id': id}), 'modal-btn-' + id);
                                    dojo.connect($("more_nobonus_button_" + id), 'onclick', this, 'onModalValidClick');
                                }
                                return id;
                            }
                            break;
                        case MODAL_TYPE_TROC:
                            var cardChoices = this.filterProperty(requiredProperties, optionnalProperties);
                            this.forcedTarget = true;
                            this.openModal(modalTitle, MODAL_TYPE_CARD, card, cardChoices);
                            break;
                        default:
                            this.showMessage(_('Unsupported call : ') + choiceType, "error");
                            break;
                    }
                },

                filterProperty: function (properties, filter) {
                    var selectableCards = [];
                    for (var hCardKey in properties) {
                        var hCard = properties[hCardKey];
                        if (hCard.id !== parseInt(filter.dataset.id)) {
                            selectableCards.push(hCard);
                        }
                    }
                    return selectableCards;
                },

                generateCardSelection: function (selectableCards, card, id) {
                    for (var hCardKey in selectableCards) {
                        var hCard = selectableCards[hCardKey];
                        hCard.idPrefix = "more_";

                        dojo.place(this.format_block('jstpl_visible_card', hCard), 'modal-selection-' + id);
                        var searchedDiv = document.getElementById('card_more_' + hCard.id)
                        var _this = this;

                        searchedDiv.addEventListener('click', (function (playedCard, additionalCard, id) {
                            return function () {
                                _this.onMoreClick(playedCard, additionalCard, id);
                            };
                        })(card, hCard, id));

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

                        targetDiv.addEventListener('click', (function (targetedPlayer) {
                            return function () {
                                _this.onMoreTargetClick(targetedPlayer);
                            };
                        })(player));

                    }
                },

                getPlayerStatsInfos: function (player, id) {
                    var tplData = {id: id};

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

                    return tplData;
                },

                generatePlayerStat: function (player, card, id) {
                    dojo.place(this.format_block('jstpl_target_with_card', this.getPlayerStatsInfos(player, id)), 'modal-selection-' + id);

                    var targetDiv = $("target_" + player.id + "_" + id);
                    var _this = this;

                    targetDiv.addEventListener('click', (function (targetedPlayer, playedCard, id) {
                        return function () {
                            _this.onTargetClick(targetedPlayer, playedCard, id);
                        };
                    })(player, card, id));
                },

                generateTargetStatSelection: function (requiredProperties, optionalProperties, card, id) {
                    var haveChoice = false;
                    for (var playerId in this.gamedatas.tables) {
                        var table = this.gamedatas.tables[playerId];
                        var player = table.player;

                        this.generatePlayerStat(player, card, id);
                        this.generatePropertiesChoices(requiredProperties, table, player);

                        var choices = dojo.query('#target_' + player.id + '_' + id + ' .cardontable');

                        if (null !== requiredProperties && requiredProperties.length !== choices.length) {
                            dojo.destroy('target_' + player.id + '_' + id);
                        } else {
                            this.generatePropertiesChoices(optionalProperties, table, player);
                            haveChoice = true;
                        }
                    }
                    if (!haveChoice) {
                        this.showMessage(_('No target aviable now'), "error");
                        dojo.destroy("modal_" + id);

                    }
                },

                generatePropertiesChoices: function (properties, table, player) {
                    for (var kProperty in properties) {
                        var property = properties[kProperty];

                        var pCard = this.getPropertyValue(table, property);

                        this.generateTargetSelectionCard(pCard, player);
                    }
                },

                generateModale: function (title, destination) {
                    if (typeof destination === "undefined") {
                        destination = 'modal-container';
                    }
                    var id = this.generateUniqueId();
                    dojo.place(this.format_block('jstpl_modal_v2', {'title': title, 'id': id}), destination);
                    dojo.connect($("more_cancel_button_" + id), 'onclick', this, 'onModalCancelClick');
                    return id;
                },

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
                    var data = this.playData;
                    data.target = player.id;
                    this.takeAction('playCard', data);
                },

                onMoreClick: function (playedCard, additionalCard, id) {
                    var searchedDiv = $('card_more_' + additionalCard.id);
                    var targetChoice = dojo.query('#target-selection .action-button');

                    if (!searchedDiv.classList.contains("selected")) {
                        dojo.query("#modal_" + id + " .selected").removeClass("selected");
                        searchedDiv.classList.add("selected");
                    } else if (this.forcedTarget) {
                        this.playData = {
                            additionalCards: [additionalCard.id],
                            card: playedCard.dataset.id
                        };
                        var idNew = this.generateModale(_('CHOOSE_PLAYER_TARGET'));
                        this.generateTargetStatSelection(null, null, playedCard, idNew);
//                        this.generateTagetSelection(idNew); -- sc-800 : Remove for new modal stats
//                        generateTargetStatSelection: function (requiredProperties, optionalProperties, card, id) 
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

                onTargetClick: function (player, card, id) {
                    var aviableCard = dojo.query("#target_card_" + player.id + " .cardontable");
                    var selectedCard = dojo.query("#target_card_" + player.id + " .selected");
                    var targetPlayer = dojo.query("#modal_" + id + " .target_" + player.id);

                    if (0 !== selectedCard.length || 0 === aviableCard.length) {
                        if (!dojo.hasClass(targetPlayer[0], "selected")) {
                            dojo.query(".target_selection.selected").removeClass("selected");
                            dojo.addClass(targetPlayer[0], "selected");
                        } else {
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
                        }

                    } else {
                        dojo.query("#more-container .selected").removeClass("selected");
                        aviableCard.forEach(function (element) {
                            dojo.addClass(element, "selected");
                        });
                        dojo.addClass(dojo.query("#target_card_" + player.id), "selected");
                        dojo.addClass(targetPlayer[0], "selected");
                    }
                },

                onMoreTargetClick: function (player) {
                    var playedCard = dojo.query("#game_container .selected");
                    var additionalCard = dojo.query("#more-container .selected");

                    if (1 !== additionalCard.length || 1 !== playedCard.length) {
                        this.showMessage(_('Invalid Card Selection'), "error");
                        dojo.query("#more-container .selected").removeClass("selected");
                    } else {
                        var card = playedCard[0];
                        var data = {
                            target: player.id,
                            card: card.dataset.id,
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