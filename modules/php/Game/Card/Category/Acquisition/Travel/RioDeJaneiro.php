<?php
namespace SmileLife\Game\Card\Category\Acquisition\Travel;

use SmileLife\Game\Card\CardType;
use SmileLife\Game\Card\Category\Acquisition\Travel\Travel;
use SmileLife\Game\Card\Module\BaseGame;

/**
 * Description of RioDeJaneiroTravel
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class RioDeJaneiro extends Travel implements BaseGame {

    public function __construct() {
        parent::__construct();

        $this->setSubtitle(clienttranslate('Rio de Janeiro'));
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    public function getType(): int {
        return CardType::TRAVEL_RIO;
    }

    public function getClass(): string {
        return self::class;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame is in Travel 
     * ---------------------------------------------------------------------- */
}
