<?php
namespace SmileLife\Game\Card\Event;

use Core\Event\EventListener\EventListener;
/**
 * Description of CardDiscardEventListener
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class CardDiscardEventListener extends EventListener{
    
    public function onEvent($object) {
        die('CDEL - OK');
    }
    
}
