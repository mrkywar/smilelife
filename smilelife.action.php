<?php

/**
 * ------
 * BGA framework: © Gregory Isabelli <gisabelli@boardgamearena.com> & Emmanuel Colin <ecolin@boardgamearena.com>
 * SmileLife implementation : © Jean Portemer <jportemer@mailz.org> & Mr_Kywar <mr_kywar@gmail.com>
 *
 * This code has been produced on the BGA studio platform for use on https://boardgamearena.com.
 * See http://en.doc.boardgamearena.com/Studio for more information.
 * -----
 * 
 * smilelife.action.php
 *
 * Smile Life main action entry point
 *
 *
 * In this file, you are describing all the methods that can be called from your
 * user interface logic (javascript).
 *       
 * If you define a method "myAction" here, then you can call it from your javascript code with:
 * this.ajaxcall( "/smilelife/smilelife/myAction.html", ...)
 *
 */
class action_smilelife extends APP_GameAction {

    // Constructor: please do not modify
    public function __default() {
        if (self::isArg('notifwindow')) {
            $this->view = "common_notifwindow";
            $this->viewArgs['table'] = self::getArg("table", AT_posint, true);
        } else {
            $this->view = "smilelife_smilelife";
            self::trace("Complete reinitialization of board game");
        }
    }

    public function resign() {
        self::setAjaxMode();

        $this->game->actionResign();

        self::ajaxResponse();
    }

    public function draw(){
        self::setAjaxMode();

        $this->game->actionDraw();

        self::ajaxResponse();
    }
    
    public function playCard(){
        self::setAjaxMode();
        
        $cardId = self::getArg("card", AT_posint, true);
        $targetId = self::getArg("target", AT_posint);

        $this->game->actionPlayCard($cardId, $targetId);

        self::ajaxResponse();
    }
    
    public function pass(){
        self::setAjaxMode();
        
        $cardId = self::getArg("card", AT_posint, true);

        $this->game->actionDiscard($cardId);

        self::ajaxResponse();
        
    }
    
    public function playFromDiscard(){
        self::setAjaxMode();

        $this->game->actionPlayFromDiscard();

        self::ajaxResponse();
    }
}
