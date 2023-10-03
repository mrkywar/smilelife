define([
    "dojo",
    "dojo/_base/declare",
], function (dojo, declare) {
    return declare(
            "smilelife.card.display",
            [],
            {
                displayCard: function (card, destinationDivId, fromDivId, destroy) {
                    if (typeof destroy === 'undefined') {
                        destroy = false;
                    }
//                    this.debug('CD-MAIN',card);
                    if (typeof card === 'undefined') {
                        card = {};
                    }
//                    this.debug('CD-MAIN',card);
                    var searchedDiv = $('card_' + card.id);
                    if (searchedDiv && fromDivId) {
//                        this.debug('CD-DC-MoReq', card);
                        //-- Move Request
                        this.moveExistingCard(searchedDiv, destinationDivId, destroy, card);
                    } else if (fromDivId) {
//                        this.debug('CD-DC-NeCard', card, searchedDiv, fromDivId);
                        //-- Move a new Card (draw or opponent action)
                        this.moveNewCard(destinationDivId, fromDivId, card);
                    } else if (!searchedDiv) {
//                        this.debug('CD-DC-NoMove', card);
                        //-- display without move
                        this.createNewCard(destinationDivId, card);
                    } else {
                        this.debug("CD-DC-OverDisp", card, searchedDiv);
                        var newCardDiv = dojo.place(searchedDiv, destinationDivId);
                    }

                },

                moveExistingCard: function (searchedDiv, destinationDivId, destroy, card) {
                    searchedDiv.id = "temp_" + searchedDiv.id;
                    this.slideToObjectAndDestroy(searchedDiv, destinationDivId, this.animationTimer);
                    if (!destroy) {
                        var _this = this;
                        setTimeout(function () {
                            _this.displayCard(card, destinationDivId);
                        }, this.animationTimer + 15)
                        //                        $(searchedDiv.id).remove();
                    }
                },

                moveNewCard: function (destinationDivId, fromDivId, card) {
//                    this.debug('CD-MNC',card);
                    card.idPrefix = 'temp_';
                    var newCardDiv = null;
                    if (card.type && !card.isFlipped) {
                        newCardDiv = dojo.place(this.format_block('jstpl_visible_card', card), destinationDivId);
                    } else {
                        newCardDiv = dojo.place(this.format_block('jstpl_hidden_card', card), destinationDivId);
                    }
                    newCardDiv.classList.add('movedcard');

                    this.slideTemporary(newCardDiv, fromDivId, fromDivId, destinationDivId, this.animationTimer, 0).then(() => {
                        if (card.type) {
                            this.displayCard(card, destinationDivId);
                        }
                    });
                },

                createNewCard: function (destinationDivId, card) {
                    card.idPrefix = "";
//                    this.debug('CD-CRNC',card);
                    var newCardDiv = null;
                    if (card.type && !card.isFlipped) {
                        newCardDiv = dojo.place(this.format_block('jstpl_visible_card', card), destinationDivId);
                    } else {
                        newCardDiv = dojo.place(this.format_block('jstpl_hidden_card', card), destinationDivId);
                    }
                    if (card.isUsed) {
                        dojo.addClass(newCardDiv, "usedcard");
                    }

                    this.updateDiscard();
                    dojo.connect(newCardDiv, 'onclick', (evt) => {
                        evt.preventDefault();
                        evt.stopPropagation();
                        this.onCardClick(card);
                    });
                }

            }
    );
});