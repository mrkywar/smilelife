define([
    'dojo',
    'dojo/_base/declare',
    'ebg/core/gamegui',
    g_gamethemeurl + 'modules/js/Core/ToolsTrait.js',
    g_gamethemeurl + 'modules/js/State/DrawStateTrait.js',
], function (dojo, declare) {
    return declare(
            'smilelife.StatesManager',
            [
                common.ToolsTrait,
                smilelife.state.draw
            ],
            {

                constructor: function () {
//                    this.debug('smilelife.StatesManager constructor');
                    this.debug("??",this);
                },

                ///////////////////////////////////////////////////
                //// Game & client states

                // onEnteringState: this method is called each time we are entering into a new game state.
                //                  You can use this method to perform some user interface changes at this moment.
                //
                onEnteringState: function (stateName, args)
                {
                    this.debug('Entering state: ' + stateName);

                    switch (stateName)
                    {
                        /* Example:
                         
                         case 'myGameState':
                         
                         // Show some HTML block at this game state
                         dojo.style( 'my_html_block_id', 'display', 'block' );
                         
                         break;
                         */


                        case 'dummmy':
                            break;
                    }
                },

                // onLeavingState: this method is called each time we are leaving a game state.
                //                 You can use this method to perform some user interface changes at this moment.
                //
                onLeavingState: function (stateName)
                {
                    this.debug('Leaving state: ' + stateName);

                    switch (stateName)
                    {

                        /* Example:
                         
                         case 'myGameState':
                         
                         // Hide the HTML block we are displaying only during this game state
                         dojo.style( 'my_html_block_id', 'display', 'none' );
                         
                         break;
                         */


                        case 'dummmy':
                            break;
                    }
                },

                // onUpdateActionButtons: in this method you can manage "action buttons" that are displayed in the
                //                        action status bar (ie: the HTML links in the status bar).
                //        
                onUpdateActionButtons: function (stateName, args)
                {
                    this.debug('onUpdateActionButtons: ' + stateName);

                    if (this.isCurrentPlayerActive())
                    {
                        switch (stateName)
                        {
                            case "playerTurn":
                                this.addActionButton('doDraw_button', _('Play cards'), 'doDraw', null, false, 'blue');
                                this.addActionButton('doDrawFromDiscard_button', _('Reset'), 'doDrawFromDiscard', null, false, 'gray');
                                break;
                                /*               
                                 Example:
                                 
                                 case 'myGameState':
                                 
                                 // Add 3 action buttons in the action status bar:
                                 
                                 this.addActionButton( 'button_1_id', _('Button 1 label'), 'onMyMethodToCall1' ); 
                                 this.addActionButton( 'button_2_id', _('Button 2 label'), 'onMyMethodToCall2' ); 
                                 this.addActionButton( 'button_3_id', _('Button 3 label'), 'onMyMethodToCall3' ); 
                                 break;
                                 */
                        }
                    }
                },

            }

    );
});
