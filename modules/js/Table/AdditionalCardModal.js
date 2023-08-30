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

                    this.debug(card);
                    for (var hCardKey in this.myHand) {
                        var hCard = this.myHand[hCardKey];
                        if (hCard.id != card.dataset.id) {
                            dojo.place(this.format_block('jstpl_card_more', hCard), 'modal-selection');
//                            dojo.connect($("card_more_"+hCard.id),'onclick', this, 'onMoreClick');
                            var searchedDiv = document.getElementById('card_more_' + hCard.id)
                            this.debug(searchedDiv);
                            var _this = this;

                            searchedDiv.addEventListener('click', (function (playedCard, additionalCard) {
                                return function () {
                                    _this.onMoreClick(playedCard, additionalCard);
                                };
                            })(card, hCard));
                        }
                    }

                    dojo.connect($("additionalCancel_button"), 'onclick', this, 'onModalCloseClick');
                },

//
                onMoreClick: function (playedCard, additionalCard) {
                    var searchedDiv = $('card_more_' + additionalCard.id);
//                    this.debug("mce", additionalCard,searchedDiv);

                    if (!searchedDiv.classList.contains("selected")) {
                        dojo.query("#more-container .selected").removeClass("selected");
                        searchedDiv.classList.add("selected");
                    } else {
                        var data = {
                            card: playedCard.dataset.id,
                            additionalCard: [additionalCard.id]
                        };
                        this.debug(data);
//                        this.takeAction('playCard', data);
                    }


                },

            }
    );
});