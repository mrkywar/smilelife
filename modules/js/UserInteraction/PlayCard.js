define([
    "dojo",
    "dojo/_base/declare",
], function (dojo, declare) {
    return declare(
            "smilelife.ui.playCard",
            [],
            {
                constructor: function () {
                },

                addPlayCardInteraction: function () {
                    this.addActionButton('play_button', _('Play card'), 'doPlay', null, false, 'blue');
                    this.addActionButton('discard_button', _('Discard card and pass'), 'doPass', null, false, 'red');
                },

                cardPlay: function (playedCard, action) {

                    switch (this.getCardType(playedCard)) {
//                      //--- BEGIN CASES : Choose A Another Card
                        case CARD_TYPE_SHOOTING_STAR:
                            var modalTitle = _('CHOOSE_ADDITIONAL_CARD_IN_DISCARD');
                            var properties = this.discard;
                            var displayAll = false;
                            this.openModal(modalTitle, MODAL_TYPE_CARD, playedCard, properties, displayAll);
                            break;
                        case CARD_TYPE_ASTRONAUT:
                            var modalTitle = _('CHOOSE_ADDITIONAL_CARD_IN_DISCARD');
                            var properties = this.discard;
                            var displayAll = true;
                            this.openModal(modalTitle, MODAL_TYPE_CARD, playedCard, properties, displayAll);
                            break;
                        case CARD_TYPE_HEAD_OF_PURCHASING:
                        case CARD_TYPE_HEAD_OF_SALES:
                            this.forcedTarget = true;
                            var modalTitle = _('CHOOSE_ADDITIONAL_CARD_IN_HAND');
                            var properties = this.getHandCardsExceptPlayed(playedCard);
                            var displayAll = false;
                            this.openModal(modalTitle, MODAL_TYPE_CARD, playedCard, properties, displayAll);
                            break;
                        case CARD_TYPE_REVENGE:
                            this.debug('REV',this.myTable);
                            break;
//                      //--- BEGIN CASES : Choose Targeted Player
                        case CARD_TYPE_DISMISSAL:
                        case CARD_TYPE_BURN_OUT:
                            var modalTitle = _('CHOOSE_PLAYER_TARGET');
                            var properties = ['job'];
                            var displayAll = true;
                            this.openModal(modalTitle, MODAL_TYPE_TARGET, playedCard, properties, displayAll);
                            break;
                        case CARD_TYPE_ACCIDENT:
                        case CARD_TYPE_SICKNESS:
                            var modalTitle = _('CHOOSE_PLAYER_TARGET');
                            var properties = ['job'];
                            var displayAll = false;
                            this.openModal(modalTitle, MODAL_TYPE_TARGET, playedCard, properties, displayAll);
                            break;
                        case CARD_TYPE_GRADE_REPETITION:
                            var modalTitle = _('CHOOSE_PLAYER_TARGET');
                            var properties = ['studiesOnly', 'job'];
                            var displayAll = false;
                            this.openModal(modalTitle, MODAL_TYPE_TARGET, playedCard, properties, displayAll);
                            break;
                        case CARD_TYPE_DIVORCE:
                            var modalTitle = _('CHOOSE_PLAYER_TARGET');
                            var properties = ['marriage', 'job'];
                            var displayAll = false;
                            this.openModal(modalTitle, MODAL_TYPE_TARGET, playedCard, properties, displayAll);
                            break;
                        case CARD_TYPE_INCOME_TAX:
                            var modalTitle = _('CHOOSE_PLAYER_TARGET');
                            var properties = ['wages', 'job'];
                            var displayAll = false;
                            this.openModal(modalTitle, MODAL_TYPE_TARGET, playedCard, properties, displayAll);
                            break;
                        case CARD_TYPE_TROC:
                            var modalTitle = _('CHOOSE_PLAYER_TARGET');
                            var properties = null;
                            var displayAll = true;
                            this.openModal(modalTitle, MODALE_TYPE_TARGET, playedCard, properties, displayAll);
                            break;
//                      //--- BEGIN CASES : Specific Card (no modale)       
                        case CARD_TYPE_JAIL:
                            this.jailPlayed(playedCard);
                            break;
                        default:
                            if ('attack' === playedCard.dataset.category && CARD_TYPE_ATTENTAT != playedCard.dataset.type) {
                                this.debug('PC-CP-DEFAULT - OLD ATTACK MODAL');
                                this.attackModal(playedCard);
                            } else {
                                this.debug('PC-CP-DEFAULT - OLD MODAL');
                                var data = this.playData;
                                this.playData = null;
                                if (null === data) {
                                    data = {
                                        card: playedCard.dataset.id
                                    };
                                }
//                                this.debug(this.playData);
                                this.takeAction(action, data);
                            }
                            break;
                    }

                },

                doPlay: function () {
                    var card = dojo.query(".selected");
                    if (1 !== card.length) {

                        this.showMessage(_('Invalid Card Selection'), "error");
                        dojo.query(".selected").removeClass("selected");
                    } else {
                        var playedCard = card[0];

                        this.cardPlay(playedCard, 'playCard');
                    }
                },

                doPass: function () {
                    var card = dojo.query(".selected");

                    if (1 !== card.length) {
                        this.showMessage(_('Invalid Card Selection'), "error");
                        dojo.query(".selected").removeClass("selected");

                    } else {
                        var data = {
                            card: card[0].dataset.id
                        };
                        this.takeAction('pass', data);
                    }
                },

                getHandCardsExceptPlayed: function (card) {
                    var selectableCards = [];
                    for (var hCardKey in this.myHand) {
                        var hCard = this.myHand[hCardKey];
                        if (hCard.id !== intval(card.dataset.id)) {
                            selectableCards.push(hCard);
                        }
                    }
                    return selectableCards;
                },

                jailPlayed: function (card) {
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

                }

            }

    );
});

