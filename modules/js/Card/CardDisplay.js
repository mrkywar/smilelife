define([
    "dojo",
    "dojo/_base/declare",
], function (dojo, declare) {
    return declare(
            "smilelife.card.display",
            [],
            {
                displayCard: function (card, destinationDivId, fromDivId) {
                    this.debug("DC", card);

                    var searchedDiv = $('card_' + card.id);

                    if (searchedDiv && card.isUsed) {
                        this.displayCard("???");
                        dojo.addClass(searchedDiv, "usedCard");
                    }
                    if (card.id == "208") {
                        this.debug("did i see ???", searchedDiv, card.isUsed);
                    }

                    if (searchedDiv && fromDivId) {
                        //-- Move Request
//                        this.debug("DC-MR");
                        searchedDiv.id = "temp_" + searchedDiv.id;
                        this.slideToObjectAndDestroy(searchedDiv, destinationDivId, this.animationTimer);
                        var _this = this;
                        setTimeout(function () {
                            _this.debug("DIS", card);
                            _this.displayCard(card, destinationDivId);
                        }, this.animationTimer + 5)
//                        $(searchedDiv.id).remove();
                    } else if (fromDivId) {
                        //-- Move a new Card (draw or opponent action)
//                        this.debug("DC-NC");
                        var initialId = card.id
                        card.id = 'temp_' + card.id;

                        var newCardDiv = dojo.place(this.format_block('jstpl_card', card), destinationDivId);
                        if (card.type && !card.isFlipped) {
                            this.displayCardInformations(newCardDiv, card);
                        }
                        newCardDiv.classList.add('movedcard');
                        this.slideTemporary(newCardDiv, fromDivId, fromDivId, destinationDivId, this.animationTimer, 0).then(() => {
                            if (card.type) {
                                card.id = initialId;
                                this.displayCard(card, destinationDivId);
                            }
                        });

                    } else if (!searchedDiv) {
                        //-- display without move
                        this.debug("DC-WM", card.type, card.isFlipped);
                        var newCardDiv = dojo.place(this.format_block('jstpl_card', card), destinationDivId);
                        if (card.isUsed) {
                            dojo.addClass(newCardDiv, "usedcard");
                        }
                        if (card.type && card.isFlipped) {
                            var pileContainer = $(destinationDivId);

                            var lastCard = pileContainer.lastElementChild;

                            // move last card in top for be displayed in first (Bottom of pile).
                            pileContainer.insertBefore(lastCard, pileContainer.firstElementChild);

                        }
                        if (card.type && !card.isFlipped) {
                            this.displayCardInformations(newCardDiv, card);
                        }

                        dojo.connect(newCardDiv, 'onclick', (evt) => {
                            evt.preventDefault();
                            evt.stopPropagation();
                            this.onCardClick(card);
                        });



                    } else {
                        this.debug("DC other display", card, searchedDiv);
                        var newCardDiv = dojo.place(searchedDiv, destinationDivId);
                    }


                },

                displayCardInformations: function (div, card) {
                    div.dataset.points = card.smilePoints;
                    div.dataset.type = '' + card.type;
                    div.dataset.category = '' + card.category;
                    div.dataset.name = '' + card.name;
                    div.dataset.id = '' + card.id;

                    $("front_" + div.id).innerHTML = `
                        <span class="card_text card_title">` + card.title + `</span>
                        <span class="card_text card_subtitle">` + card.subtitle + `</span>
                        <span class="card_text card_text1">` + card.text1 + `</span>
                        <span class="card_text card_text2">` + card.text2 + `</span>
                        <span class="debug">` + card.id + " / " + card.type + " - S : " + card.smilePoints + `</span>
                    `;

                },
            }
    );
});