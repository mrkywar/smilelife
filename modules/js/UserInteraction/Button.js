define([
    "dojo",
    "dojo/_base/declare",

    g_gamethemeurl + 'modules/js/UserInteraction/TakeCard.js',
    g_gamethemeurl + 'modules/js/UserInteraction/PlayCard.js',
    g_gamethemeurl + 'modules/js/UserInteraction/LuckAction.js',
    g_gamethemeurl + 'modules/js/UserInteraction/RainbowAction.js',
    g_gamethemeurl + 'modules/js/UserInteraction/DiscardAction.js',
    g_gamethemeurl + 'modules/js/UserInteraction/BirthdayAction.js',
], function (dojo, declare) {
    return declare(
            "smilelife.ui.button",
            [
                smilelife.ui.takeCard,
                smilelife.ui.playCard,
                smilelife.ui.luckAction,
                smilelife.ui.rainbowAction,
                smilelife.ui.discardAction,
                smilelife.ui.birthdayAction
            ],
            {
                constructor: function () {
                    this.actualState = null;
                },

                ///////////////////////////////////////////////////
                //// Game & client states

                // onEnteringState: this method is called each time we are entering into a new game state.
                //                  You can use this method to perform some user interface changes at this moment.
                //
                onEnteringState: function (stateName, args)
                {
                    this.actualState = stateName;
//                    this.debug("OES-B-36", stateName, args, this.isCurrentPlayerActive());
                },

                // onLeavingState: this method is called each time we are leaving a game state.
                //                 You can use this method to perform some user interface changes at this moment.
                //
                onLeavingState: function (stateName, args)
                {
//                    this.debug("OLS-44", stateName, args);
                    dojo.query(".selected").removeClass("selected");
                    if (this.isCurrentPlayerActive())
                    {
                        switch (stateName)
                        {
                            case "playCard":
                                this.onModalCloseClick();
                                break;

                        }
                    }
                    this.actualState = null;
                },

                // onUpdateActionButtons: in this method you can manage "action buttons" that are displayed in the
                //                        action status bar (ie: the HTML links in the status bar).
                //        
                onUpdateActionButtons: function (stateName, args)
                {
//                    this.debug("OUA-64", stateName, args, this.isCurrentPlayerActive());
//                    this.debug('state', stateName, this.isCurrentPlayerActive());
                    switch (stateName)
                    {
                        case "birthdayConsequence":
                            $('more-container').innerHTML = "";
                            $('modal-container').innerHTML = "";
                            break;
                    }
                    if (this.isCurrentPlayerActive())
                    {
                        this.playData = null;
                        switch (stateName)
                        {
                            case "takeCard":
                                this.addTakeCardInteraction();
                                break;
                            case "playCard":
                                this.addPlayCardInteraction();
                                break;
                            case "luckAction":
                                this.addLuckChoiceInteraction();
                                break;
                            case "rainbowAction":
                                this.addRainbowInteraction();
                                break;
                            case "researcherDiscard":
                                this.addDiscardInteraction();
                                break;
                            case "birthdayConsequence":
                                this.addBirthdayInteraction();
                                break;

                        }
                    }
                },
            }


    );
});




