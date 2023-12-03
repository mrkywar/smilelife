<?php

namespace SmileLife\PlayerAction;

use SmileLife\Card\Core\CardDecorator;
use SmileLife\Card\Core\CardSerializer;
use SmileLife\Game\Request\PassRequest;
use SmileLife\Table\PlayerTableDecorator;

/**
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
trait CasinoPlayTrait {

    public function casinoPlay($cardId) {
        self::checkAction('casinoPlay');
        
        var_dump($cardId);die;
        
    }
}
