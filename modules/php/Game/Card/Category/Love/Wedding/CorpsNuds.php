<?php

namespace SmileLife\Game\Card\Category\Love\Wedding;

use SmileLife\Game\Card\Core\CardType;
use SmileLife\Game\Card\Module\BaseGame;

/**
 * Description of CorpsNudsWedding
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class CorpsNuds extends Wedding implements BaseGame {
    
    public function __construct() {
        parent::__construct();
        
        $this->setText1(clienttranslate('CorpsNuds'));
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    public function getClass(): string {
        return self::class;
    }

    public function getType(): int {
        return CardType::WEDDING_CORPS_NUDS;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame is in Wedding 
     * ---------------------------------------------------------------------- */
}
