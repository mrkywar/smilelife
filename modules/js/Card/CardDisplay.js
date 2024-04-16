define([
    "dojo",
    "dojo/_base/declare",
], function (dojo, declare) {
    return declare(
            "smilelife.card.display",
            [],
            {
                constructor: function () {
                },

                displayCard: function (card, destinationDivId, fromDivId, destroy) {
                    if (typeof destroy === 'undefined') {
                        destroy = false;
                    }
                    if (typeof card === 'undefined') {
                        card = {};
                    }

//                    this.debug('DISPLAY : ', card);
                    var searchedDiv = $('card_' + card.id);
                    if (searchedDiv && fromDivId) {
                        //-- Move Request
                        this.moveExistingCard(searchedDiv, destinationDivId, destroy, card);
                    } else if (fromDivId) {
                        //-- Move a new Card (draw or opponent action)
                        this.moveNewCard(destinationDivId, fromDivId, card);
                    } else if (!searchedDiv) {
                        //-- display without move
                        this.createNewCard(destinationDivId, card);
                    } else {
                        dojo.place(searchedDiv, destinationDivId);
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
                    card.idPrefix = 'temp_';

                    var newCardDiv = this.generateCardHTML(destinationDivId, card);
                    newCardDiv.classList.add('movedcard');

                    this.slideTemporary(newCardDiv, fromDivId, fromDivId, destinationDivId, this.animationTimer, 0).then(() => {
                        if (card.type) {
                            this.displayCard(card, destinationDivId);
                        }
                    });
                },

                createNewCard: function (destinationDivId, card) {
                    card.idPrefix = "";

                    var newCardDiv = this.generateCardHTML(destinationDivId, card);

                    dojo.connect(newCardDiv, 'onclick', (evt) => {
                        evt.preventDefault();
                        evt.stopPropagation();
                        this.onCardClick(card);
                    });
                },

                generateCardHTML: function (destinationDivId, card) {
                    var newCardDiv = null;
                    if (card.type && !card.isFlipped) {
                        newCardDiv = dojo.place(this.format_block('jstpl_visible_card', card), destinationDivId);
                        this.addAdditionnalProperties(newCardDiv, card);
                    } else {
                        newCardDiv = dojo.place(this.format_block('jstpl_hidden_card', card), destinationDivId);
                    }
                    return newCardDiv;
                },

                addAdditionnalProperties: function (cardDiv, card) {
                    if (typeof card.price !== 'undefined') {
                        cardDiv.dataset.price = card.price;
                    }
                    if (typeof card.amount !== 'undefined') {
                        cardDiv.dataset.amount = card.amount;
                    }
                }



            }
    );
});