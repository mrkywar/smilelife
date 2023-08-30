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
                additionalCardModal: function (card) {
                    dojo.place(this.format_block('jstp_modal_v2', {'title': "CHOOSE_ADDITIONAL_CARD_IN_HAND"}), 'more-container');

//                    this.debug('??', this.myHand, card.dataset.id);
                    for (var hCardKey in this.myHand) {
                        var hCard = this.myHand[hCardKey];
                        if (hCard.id != card.dataset.id) {
                            dojo.place(this.format_block('jstpl_card_more', hCard), 'modal-selection');
//                            dojo.connect($("card_more_"+hCard.id),'onclick', this, 'onMoreClick');
                            var searchedDiv = document.getElementById('card_more_' + hCard.id)
                            this.debug(searchedDiv);
                            var _this = this;

                            searchedDiv.addEventListener('click', (function (cardObject) {
                                return function () {
                                    _this.onMoreClick(cardObject);
                                };
                            })(hCard));
                        }
                    }

                    dojo.connect($("additionalCancel_button"), 'onclick', this, 'onModalCloseClick');
                },

//
                onMoreClick: function (card) {
                    var searchedDiv = $('card_more_' + card.id);
                    this.debug("mce", card,searchedDiv);

                    if (!searchedDiv.classList.contains("selected")) {
                        dojo.query("#more-container .selected").removeClass("selected");
                        searchedDiv.classList.add("selected");
                    }

                },
//                    if ('takeCard' === this.actualState) {
//                        var data = {
//                            target: element.target.dataset.player
//                        };
//                        this.takeAction('playFromDiscard', data);
//                    } else {
//                        var card = dojo.query(".selected");
//                        if (1 !== card.length) {
//                            this.showMessage(_('Invalid Card Selection'), "error");
//                            dojo.query(".selected").removeClass("selected");
//                        } else {
//                            var data = {
//                                card: card[0].dataset.id,
//                                target: element.target.dataset.player
//                            };
//                            this.takeAction('playCard', data);
//                        }
//                    }
//                }



            }
    );
});