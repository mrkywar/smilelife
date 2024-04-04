<?php

namespace SmileLife\PlayerAction;

/**
 * Description of ActionType
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
abstract class ActionType {

    const ACTION_PASS = "pass";
    const ACTION_PLAY = "playCard";
    
    const ACTION_RESIGN = "resign";
    const ACTION_DECK_DRAW = "drawCard";
    const ACTION_VOLONTARY_DIVORCE = "volontaryDivorce";
    const ACTION_RESIGN_ADULTERY = "resignAdultery";
    
    const ACTION_SPECIAL_LUCK = "luckChoice";
    const ACTION_SPECIAL_STOP_RAINBOW = "stopRainbow";
    const ACTION_SPECIAL_CASINO = "casinoBet";
    const ACTION_SPECIAL_BIRTHDAY = "offerWage";
    
    
    const REQUIREMENT_REQUEST = "requirementRequest";

}
