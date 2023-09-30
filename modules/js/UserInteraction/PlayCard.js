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
                        case CARD_TYPE_HEAD_OF_PURCHASING:
                        case CARD_TYPE_HEAD_OF_SALES:
                            this.additionalTrocCardModal(playedCard);
                            break;
                        case CARD_TYPE_JAIL:
                            this.jailModal(playedCard);
                            break;
                        case CARD_TYPE_DISMISSAL:
                        case CARD_TYPE_BURN_OUT:
                            this.jobAttackModal(playedCard);
                            break;
                        case CARD_TYPE_ACCIDENT:
                        case CARD_TYPE_SICKNESS:
                            this.otherAttackModal(playedCard);
                            break;
                        case CARD_TYPE_ASTRONAUT:
                            this.astronautModal(playedCard);
                            break;
                        case CARD_TYPE_SHOOTING_STAR:
                            this.shootingStarModal(playedCard);
                            break;
                        case CARD_TYPE_GRADE_REPETITION:
                            this.gradeRepetitionModal(playedCard);
                            break;
                        case CARD_TYPE_DIVORCE:
                            this.divorceModal(playedCard);
                            break;
                        case CARD_TYPE_INCOME_TAX:
                            this.incomeTaxModal(playedCard);
                            break;
                        case CARD_TYPE_TROC:
                            this.trocModal(playedCard);
                            break;
                        case CARD_TYPE_REVENGE:
                            
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

            }

    );
});

