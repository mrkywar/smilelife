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
                    
                    dojo.connect($("more_cancel_button"), 'onclick', this, 'onModalCancelClick');
                    dojo.connect($("more_confirm_button"), 'onclick', this, 'onModalConfirmClick');

                    for (var hCardKey in this.myHand) {
                        var hCard = this.myHand[hCardKey];
                        if (hCard.id != card.dataset.id) {
                            dojo.place(this.format_block('jstpl_card_more', hCard), 'modal-selection');
                            var searchedDiv = document.getElementById('card_more_' + hCard.id)
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

                onMoreClick: function (playedCard, additionalCard) {
                    var searchedDiv = $('card_more_' + additionalCard.id);

                    if (!searchedDiv.classList.contains("selected")) {
                        dojo.query("#more-container .selected").removeClass("selected");
                        searchedDiv.classList.add("selected");
                    } else {
                        var data = {
                            card: playedCard.dataset.id,
                            additionalCards: [additionalCard.id]
                        };

                        this.takeAction('playCard', data);
                    }
                },
                
                onModalCancelClick: function(){
                    $('more-container').innerHTML = "";
                },
                
                onModalConfirmClick: function(){
                    var playedCard = dojo.query("#game_container .selected");
                    var additionalCard = dojo.query("#more-container .selected");
                    if (1 !== additionalCard.length || 1 !== playedCard.length) {
                        this.showMessage(_('Invalid Card Selection'), "error");
                        dojo.query("#more-container .selected").removeClass("selected");
                    }else{
                        var data = {
                            card: playedCard[0].dataset.id,
                            additionalCards: [additionalCard[0].dataset.id]
                        };

                        this.takeAction('playCard', data);
                    }
                }
                

            }
    );
});