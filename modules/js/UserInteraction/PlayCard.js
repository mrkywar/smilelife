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
                    if (this.isCasinoUseable()) {
                        this.addActionButton('casino_button', _('Casino : bet a salary'), 'doCasino', null, false, null);
//                        this.addActionButton('casino_button2', _('Cliquez-moi'), 'doCasino', {primary: true, disabled: false, color: 'green'});
                    }
                    this.addActionButton('play_button', _('Play card'), 'doPlay', null, false, 'blue');
                    this.addActionButton('discard_button', _('Discard card and pass'), 'doPass', null, false, 'red');


                    ;
                },

                isCasinoUseable: function () {
                    this.debug("isCU", this.casino);
                    if (this.casino.length > 0) {
                        var casinoCard = this.casino[0];

                        this.debug(parseInt(casinoCard.owner), this.player_id, this.isMyHandContainWage());

                        return(parseInt(casinoCard.owner) !== this.player_id && this.isMyHandContainWage());
                    }
                    return false;

                },

                isMyHandContainWage: function () {
                    for (var hCardKey in this.myHand) {
                        var hCard = this.myHand[hCardKey];
                        this.debug(hCard);
                        if ('wage' === hCard.category) {
                            return true;
                        }
                    }
                    return false;
                },

                cardPlay: function (playedCard, action) {
//                    this.debug('PC-CP',playedCard, action);

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
                            var properties = this.myHand
                            var optionnalProperties = playedCard;
                            this.openModal(modalTitle, MODAL_TYPE_TROC, playedCard, properties, optionnalProperties);
                            break;
                        case CARD_TYPE_REVENGE:
                            var modalTitle = _('CHOOSE_AN_SUFFERED_ATTACK');
                            var properties = this.myTable.attacks;
                            var optionnalProperties = playedCard;
                            this.openModal(modalTitle, MODAL_TYPE_CARD, playedCard, properties, optionnalProperties);
                            break;
//                      //--- BEGIN CASES : Choose Targeted Player
                        case CARD_TYPE_DISMISSAL:
                        case CARD_TYPE_BURN_OUT:
                            var modalTitle = _('CHOOSE_PLAYER_TARGET');
                            var displayAll = false;
                            var requiredProperties = ['job'];
                            var optionnalProperties = null;
                            this.openModal(modalTitle, MODAL_TYPE_TARGET, playedCard, requiredProperties, optionnalProperties);
                            break;
                        case CARD_TYPE_ACCIDENT:
                        case CARD_TYPE_SICKNESS:
                            var modalTitle = _('CHOOSE_PLAYER_TARGET');
                            var displayAll = true;
                            var requiredProperties = null;
                            var optionnalProperties = ['job'];
                            this.openModal(modalTitle, MODAL_TYPE_TARGET, playedCard, requiredProperties, optionnalProperties);
                            break;
                        case CARD_TYPE_GRADE_REPETITION:
                            var modalTitle = _('CHOOSE_PLAYER_TARGET');
                            var displayAll = false;
                            var requiredProperties = ['studiesOnly'];
                            var optionnalProperties = ['job'];
                            this.openModal(modalTitle, MODAL_TYPE_TARGET, playedCard, requiredProperties, optionnalProperties);
                            break;
                        case CARD_TYPE_DIVORCE:
                            var modalTitle = _('CHOOSE_PLAYER_TARGET');
                            var displayAll = false;
                            var requiredProperties = ['marriage'];
                            var optionnalProperties = ['job'];
                            this.openModal(modalTitle, MODAL_TYPE_TARGET, playedCard, requiredProperties, optionnalProperties);
                            break;
                        case CARD_TYPE_INCOME_TAX:
                            var modalTitle = _('CHOOSE_PLAYER_TARGET');
                            var displayAll = false;
                            var requiredProperties = ['wages'];
                            var optionnalProperties = ['job'];
                            this.openModal(modalTitle, MODAL_TYPE_TARGET, playedCard, requiredProperties, optionnalProperties);
                            break;
                        case CARD_TYPE_TROC:
                            var modalTitle = _('CHOOSE_PLAYER_TARGET');
                            var displayAll = true;
                            var requiredProperties = null;
                            var optionnalProperties = null;
                            this.openModal(modalTitle, MODAL_TYPE_TARGET, playedCard, requiredProperties, optionnalProperties);
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
                                if (null === this.playData) {
                                    this.playData = {
                                        card: playedCard.dataset.id
                                    };
                                }
                                if (typeof this.playData.additionalCard !== 'undefined' && null !== this.playData.additionalCards) {
                                    this.playData.additionalCards = this.playData.additionalCards.toString();
                                }

                                this.takeAction(action, this.playData);
                            }
                            break;
                    }

                },

                doPlay: function () {
                    var card = dojo.query("#myhand .selected");

                    if (1 !== card.length) {

                        this.showMessage(_('Invalid Card Selection'), "error");
                        dojo.query(".selected").removeClass("selected");
                    } else {
                        var playedCard = card[0];
                        this.playData = {
                            card: playedCard.dataset.id
                        };

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

                doCasino: function () {
                    var card = dojo.query(".selected");

                    if (1 !== card.length || 'wage' !== card[0].dataset.category) {
                        this.showMessage(_('Invalid Card Selection'), "error");
                        dojo.query(".selected").removeClass("selected");
                    } else {
                        var data = {
                            card: card[0].dataset.id
                        };
                        this.takeAction('casinoPlay', data);
                    }

                },

                getHandCardsExceptPlayed: function (card) {
                    var selectableCards = [];
                    for (var hCardKey in this.myHand) {
                        var hCard = this.myHand[hCardKey];
                        if (hCard.id !== parseInt(card.dataset.id)) {
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

