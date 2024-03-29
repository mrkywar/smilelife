//-- MODALE : Declare All supported Type
const MODAL_TYPE_TARGET = "target";
const MODAL_TYPE_CARD = "card";
const MODAL_TYPE_DISPLAY = "display";
const MODAL_TYPE_DISPLAY_MULTI = "displayPlayer";
const MODAL_TYPE_TROC = "troc";
const MODAL_TYPE_LUCK_CHOICE = "luckChoice";
const MODAL_TYPE_PAY_TRAVEL = "payTravel";
const MODAL_TYPE_PAY_HOUSE = "payHouse";

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
                    this.houseData = null;
                    this.forcedTarget = false;
                    this.oCard = null;
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
                                    hCard.idPrefix = "more_" + id + "_";

                                    var newCardDiv = dojo.place(this.format_block('jstpl_visible_card', hCard), 'target_card_' + player.id);
                                    this.addAdditionnalProperties(newCardDiv, hCard);
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
                            var id = this.generateModale(modalTitle);
                            if (0 === requiredProperties.length) {
                                this.showMessage(_('No eligible cards'), "error");
                            } else {

                                if (null !== this.playData && typeof this.playData.additionalCards !== "undefined" && 1 === this.playData.additionalCards.length) {
                                    var fictiveCard = {dataset: {id: this.playData.additionalCards[0]}};
                                    requiredProperties = this.filterProperty(requiredProperties, fictiveCard);

                                }
                                if (0 === requiredProperties.length) {
                                    dojo.place(`<h3>` + _('No eligible cards, play the card anyway') + `</h3>`, 'modal-selection-' + id);
                                } else {

                                    this.generateCardSelection(requiredProperties, card, id);
                                }

                                if (CARD_TYPE_ASTRONAUT === parseInt(card.dataset.type) || CARD_TYPE_CASINO) {
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
                        case MODAL_TYPE_LUCK_CHOICE:
                            var id = this.generateModale(modalTitle, "special-container");
                            var luckCallbackHandler = this.onLuckClick;
                            this.generateCardSelection(this.luckCards, card, id, luckCallbackHandler);
                            break;
                        case MODAL_TYPE_PAY_TRAVEL:
                            var isPilot = this.isMyJobPilot();
                            var aviableWages = this.getUsableWages();

                            if (isPilot) {
                                this.onModalValidClick();
                            } else if (aviableWages.length < 1) {
                                // -- TODO : Calcul si le mini est atteint (prix du voyage / argent dispo)

                                this.showMessage(_('Not Enouth Wages Aviables'), "error");
                            } else {
                                var id = this.generateModale(modalTitle, "more-container");

                                dojo.place(this.format_block('jstpl_buy_aquisition', {'price': 3}), 'modal-selection-' + id);
                                dojo.place(this.format_block('jstpl_btn_valid', {'id': id}), 'modal-btn-' + id);
                                dojo.connect($("more_valid_button_" + id), 'onclick', this, function () {
                                    this.onModalBuyClick(card, id);
                                }.bind(this));
                                dojo.place(this.format_block('jstpl_btn_reset', {'id': id}), 'modal-btn-' + id);
                                dojo.connect($("more_reset_button_" + id), 'onclick', this, function () {
                                    this.onResetBuyClick(id);
                                }.bind(this));

                                this.generateCardSelection(aviableWages, card, id, this.onTravelBuyClick);
                            }
                            break;
                        case MODAL_TYPE_PAY_HOUSE:
                            var isArchitetUsable = this.isMyJobAchitectUsable();
                            this.debug("House", isArchitetUsable, this.getMyMarriage());
                            var aviableWages = this.getUsableWages();
                            this.houseDatas = {'initialPrice': parseInt(card.dataset.price), 'price': (null !== this.getMyMarriage()) ? card.dataset.price / 2 : card.dataset.price};
                            if (aviableWages.length < 1 && !isArchitetUsable) {
                                // -- TODO : Calcul si le mini est atteint (prix du voyage / argent dispo)
                                this.showMessage(_('Not Enouth Wages Aviables'), "error");
                            } else {
                                var id = this.generateModale(modalTitle, "more-container");

                                dojo.place(this.format_block('jstpl_buy_aquisition', {'price': this.houseDatas.price}), 'modal-selection-' + id);
                                dojo.place(this.format_block('jstpl_btn_valid', {'id': id}), 'modal-btn-' + id);
                                dojo.connect($("more_valid_button_" + id), 'onclick', this, function () {
                                    this.onModalBuyClick(card, id);
                                }.bind(this));
                                if (isArchitetUsable) {
                                    dojo.place(this.format_block('jstpl_btn_achitect', {'id': id}), 'modal-btn-' + id);
                                    dojo.connect($("more_architect_button_" + id), 'onclick', this, function () {
                                        this.onModalArchitectBuyClick(card, id);
                                    }.bind(this));
                                }
                                dojo.place(this.format_block('jstpl_btn_reset', {'id': id}), 'modal-btn-' + id);
                                dojo.connect($("more_reset_button_" + id), 'onclick', this, function () {
                                    this.onResetBuyClick(id);
                                }.bind(this));

                                this.generateCardSelection(aviableWages, card, id, this.onHouseBuyClick);
                            }
                            this.debug("Price", this.houseDatas);
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

                generateCardSelection: function (selectableCards, card, id, callback) {
                    if (typeof callback === "undefined") {
                        callback = this.onMoreClick.bind(this);
                    } else {
                        callback = callback.bind(this);
                    }

                    for (var hCardKey in selectableCards) {
                        var hCard = selectableCards[hCardKey];
                        hCard.idPrefix = "more_" + id + "_";

                        var newCardDiv = dojo.place(this.format_block('jstpl_visible_card', hCard), 'modal-selection-' + id);
                        this.addAdditionnalProperties(newCardDiv, hCard);
                        var searchedDiv = document.getElementById('card_more_' + id + "_" + hCard.id);

                        // Utilisation d'une fonction immédiate pour encapsuler les valeurs
                        (function (playedCard, currentHCard, currentId) {
                            searchedDiv.addEventListener('click', function () {
                                callback(playedCard, currentHCard, currentId);
                            });
                        })(card, hCard, id);
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

                generateTargetSelectionCard: function (card, player, id) {
                    if (null !== card) {
                        card.idPrefix = "more_" + id + "_";
                        var newCardDiv = dojo.place(this.format_block('jstpl_visible_card', card), 'target_card_' + player.id);
                        this.addAdditionnalProperties(newCardDiv, card);
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
                        this.generatePropertiesChoices(requiredProperties, table, player, id);

                        var choices = dojo.query('#target_' + player.id + '_' + id + ' .cardontable');

                        if (null !== requiredProperties && requiredProperties.length !== choices.length) {
                            dojo.destroy('target_' + player.id + '_' + id);
                        } else {
                            this.generatePropertiesChoices(optionalProperties, table, player, id);
                            haveChoice = true;
                        }
                    }
                    if (!haveChoice) {
                        this.showMessage(_('No target aviable now'), "error");
                        dojo.destroy("modal_" + id);

                    }
                },

                generatePropertiesChoices: function (properties, table, player, id) {
                    for (var kProperty in properties) {
                        var property = properties[kProperty];

                        var pCard = this.getPropertyValue(table, property);

                        this.generateTargetSelectionCard(pCard, player, id);
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

                    var data = this.playData;
                    if (null === data) {
                        data = {
                            card: playedCard[0].dataset.id
                        }
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
                    var searchedDiv = $('card_more_' + id + "_" + additionalCard.id);
                    var targetChoice = dojo.query('#target-selection .action-button');

                    if (!searchedDiv.classList.contains("selected")) {
                        dojo.query("#modal_" + id + " .selected").removeClass("selected");
                        searchedDiv.classList.add("selected");
                    } else if (this.forcedTarget) {
                        this.playData = {
                            additionalCards: [additionalCard.id],
                            card: playedCard.dataset.id
                        };
                        this.oCard = playedCard;
                        var idNew = this.generateModale(_('CHOOSE_PLAYER_TARGET'));
                        this.generateTargetStatSelection(null, null, playedCard, idNew);
                    } else if (0 === targetChoice.length) {
                        if (null === this.playData || typeof this.playData.additionalCards === "undefined") {
                            this.playData = {
                                additionalCards: [searchedDiv.dataset.id],
                                card: playedCard.dataset.id
                            };
                            this.oCard = playedCard;
                        } else {
                            this.playData.additionalCards.push(searchedDiv.dataset.id);
                        }
                        if ('discard' === this.oCard.dataset.location) {
                            this.cardPlay(searchedDiv, 'playFromDiscard');
                        } else {
                            this.cardPlay(searchedDiv, 'playCard');
                        }
                    }

                    return false;
                },

                onLuckClick: function (playedCard, additionalCard, id) {
                    var searchedDiv = $('card_more_' + id + "_" + additionalCard.id);
                    if (!searchedDiv.classList.contains("selected")) {
                        dojo.query("#modal_" + id + " .selected").removeClass("selected");
                        searchedDiv.classList.add("selected");
                    } else {
                        var data = {
                            card: additionalCard.id
                        };
                        this.takeAction('luckChoice', data);
                    }

                    return false;
                },

                onModalCancelClick: function (event) {
                    dojo.destroy("modal_" + event.target.dataset.modal);

                    this.playData = null;
                },

                onMoreTargetClick: function (player) {
                    var playedCard = dojo.query("#game_container .selected");
                    var additionalCard = dojo.query("#more-container .selected");

                    if (1 !== additionalCard.length || 1 !== playedCard.length) {
                        this.showMessage(_('Invalid Card Selection'), "error");
                        dojo.query("#more-container .selected").removeClass("selected");
                    } else {
                        var card = playedCard[0];
                        var data = this.playData;
                        if (null === this.playData) {
                            data = {
                                card: card.dataset.id,
                                additionalCards: [additionalCard[0].dataset.id]
                            };
                            this.oCard = card;
                        }
                        data.target = player.id;
                        data.additionalCards = data.additionalCards.toString();
                        if ('discard' === card.dataset.location) {
                            this.takeAction('playFromDiscard', data);
                        } else {
                            this.takeAction('playCard', data);
                        }
                        this.forcedTarget = false;
                    }
                },

                onTargetClick: function (player, card, id) {
                    var playedCard = dojo.query("#game_container .selected");

                    var targetPlayer = dojo.query("#modal_" + id + " .target_" + player.id);
                    if (dojo.hasClass(targetPlayer[0], "selected")) {
                        if (null === this.playData) {
                            this.playData = {
                                target: player.id,
                                card: card.dataset.id
                            };
                            this.oCard = card;
                            if ('discard' === card.dataset.location) {
                                this.takeAction('playFromDiscard', this.playData);
                            } else {
                                this.takeAction('playCard', this.playData);
                            }
                        } else {
                            //--THIS IS GOOD!
                            this.playData.target = player.id;
                            if (typeof this.playData.additionalCards !== 'undefined') {
                                this.playData.additionalCards = this.playData.additionalCards.toString();
                            }

                            if ('discard' === playedCard[0].dataset.location) {
                                this.playData.additionalCards = [card.dataset.id];
                                this.takeAction('playFromDiscard', this.playData);
                            } else {
                                this.takeAction('playCard', this.playData);
                            }
                        }
                    } else {
                        dojo.removeClass(dojo.query("#modal_" + id + " .selected"), "selected");

                        var targetSelectionElements = dojo.query("#modal_" + id + " .selected");
                        targetSelectionElements.forEach(function (element) {
                            dojo.removeClass(element, "selected");
                        });

                        dojo.addClass("target_" + player.id + "_" + id, "selected");
                        var targetCardElements = dojo.query("#target_" + player.id + "_" + id + " .cardontable");
                        targetCardElements.forEach(function (element) {
                            dojo.addClass(element, "selected");
                        });
                    }

                },
                onModalBuyClick: function (card, id) {
                    var selectedIds = [];
                    var targetSelectionElements = dojo.query("#modal_" + id + " .selected");
                    targetSelectionElements.forEach(function (element) {
//                        dojo.removeClass(element, "selected");
                        selectedIds.push(element.dataset.id);
                    });

                    var data = {
                        additionalCards: selectedIds.toString(),
                        card: card.dataset.id
                    };
                    if ('discard' === card.dataset.location) {
                        this.takeAction('playFromDiscard', data);
                    } else {
                        this.takeAction('playCard', data);
                    }
                },
                onResetBuyClick: function (id) {
                    var targetSelectionElements = dojo.query("#modal_" + id + " .selected");
                    targetSelectionElements.forEach(function (element) {
                        dojo.removeClass(element, "selected");
                    });
                },
                onTravelBuyClick: function (playedCard, card, id) {
                    var clickedCard = document.getElementById("card_" + card.idPrefix + card.id);
                    var price = playedCard.dataset.price;
                    var wageAmount = clickedCard.dataset.amount;

                    var wagesSelected = new ebg.counter();
                    wagesSelected.create("wages_modal_total_spent");

                    if (clickedCard.classList.contains("selected")) {
                        clickedCard.classList.remove("selected");
                        var total = 0;
                        var targetSelectionElements = dojo.query("#modal_" + id + " .selected");
                        targetSelectionElements.forEach(function (element) {
                            total += parseInt(element.dataset.amount);
                        });

                        wagesSelected.setValue(total);
                    } else if (wageAmount >= price) {
                        var targetSelectionElements = dojo.query("#modal_" + id + " .selected");
                        targetSelectionElements.forEach(function (element) {
                            dojo.removeClass(element, "selected");
                        });
                        clickedCard.classList.add("selected");

                        wagesSelected.setValue(wageAmount);
                    } else {
                        var total = 0;
                        var targetSelectionElements = dojo.query("#modal_" + id + " .selected");
                        targetSelectionElements.forEach(function (element) {
                            total += parseInt(element.dataset.amount);
                        });
                        if (total >= price) {
                            this.showMessage(_('You have already chosen enough salary to buy this'), "error");
                        } else {
                            clickedCard.classList.add("selected");
                            total += parseInt(wageAmount);
                        }
                        wagesSelected.setValue(total);
                    }

                },
                onModalArchitectBuyClick: function (playedCard, card, id) {
                    this.debug('omabc', playedCard, card, id);
                },
                onHouseBuyClick: function (playedCard, card, id) {
                    var clickedCard = document.getElementById("card_" + card.idPrefix + card.id);
                    this.debug('ohbc', this.houseDatas, clickedCard);
                    var price = this.houseDatas.price;
                    var wageAmount = clickedCard.dataset.amount;
                    var wagesSelected = new ebg.counter();
//                    var isArchitetUsable = this.isMyJobAchitectUsable();
                    wagesSelected.create("wages_modal_total_spent");

                    //-- TODO factorize this with travel 
                    if (clickedCard.classList.contains("selected")) {
                        this.debug("ohbn - unselect");
                        clickedCard.classList.remove("selected");
                        var total = 0;
                        var targetSelectionElements = dojo.query("#modal_" + id + " .selected");
                        targetSelectionElements.forEach(function (element) {
                            total += parseInt(element.dataset.amount);
                        });

                        wagesSelected.setValue(total);
                    } else if (wageAmount >= price) {
                        this.debug("ohbn - WA", wageAmount, price);
                        var targetSelectionElements = dojo.query("#modal_" + id + " .selected");
                        targetSelectionElements.forEach(function (element) {
                            dojo.removeClass(element, "selected");
                        });
                        clickedCard.classList.add("selected");

                        wagesSelected.setValue(wageAmount);
                    } else {
                        var total = 0;
                        var targetSelectionElements = dojo.query("#modal_" + id + " .selected");
                        targetSelectionElements.forEach(function (element) {
                            total += parseInt(element.dataset.amount);
                        });
                        this.debug("ohbn - Add", total, price);
                        if (total >= price) {
                            this.showMessage(_('You have already chosen enough salary to buy this'), "error");
                        } else {
                            clickedCard.classList.add("selected");
                            total += parseInt(wageAmount);
                        }
                        wagesSelected.setValue(total);
                    }
                },
            }

    );
});