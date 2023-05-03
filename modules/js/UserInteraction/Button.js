define([
    "dojo",
    "dojo/_base/declare",

    g_gamethemeurl + 'modules/js/UserInteraction/TakeCard.js',
    g_gamethemeurl + 'modules/js/UserInteraction/PlayCard.js',
], function (dojo, declare) {
    return declare(
            "smilelife.ui.button",
            [
                smilelife.ui.takeCard,
                smilelife.ui.playCard,
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
//                    this.debug('Entering state: ' + stateName);
                    this.actualState = stateName;
                },

                // onLeavingState: this method is called each time we are leaving a game state.
                //                 You can use this method to perform some user interface changes at this moment.
                //
                onLeavingState: function (stateName)
                {
//                    this.debug('Leaving state: ' + stateName);
                    this.actualState = null;
                },

                // onUpdateActionButtons: in this method you can manage "action buttons" that are displayed in the
                //                        action status bar (ie: the HTML links in the status bar).
                //        
                onUpdateActionButtons: function (stateName, args)
                {
//                    this.debug('onUpdateActionButtons: ' + stateName);

                    if (this.isCurrentPlayerActive())
                    {
                        switch (stateName)
                        {
                            case "takeCard":
                                this.addTakeCardInteraction();
                                break;
                            case "playCard":
                                this.addPlayCardInteraction();
                                break;
                        }
                    }
                },
            }


    );
});




