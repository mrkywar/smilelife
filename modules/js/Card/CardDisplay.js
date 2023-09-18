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
                    var searchedDiv = $('card_' + card.id);
                    if (searchedDiv && fromDivId) {
                        //-- Move Request
                        this.moveCard(searchedDiv, destinationDivId, destroy);
                    } else if (fromDivId) {
                        //-- Move a new Card (draw or opponent action)
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
                    } else if (!searchedDiv) {
//                        //-- display without move
                        card.idPrefix = "";
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
                    }else {
                        this.debug("DC other display", card, searchedDiv);
                        var newCardDiv = dojo.place(searchedDiv, destinationDivId);
                    }

                },

                moveCard: function (searchedDiv, destinationDivId, destroy) {
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

            }
    );
});