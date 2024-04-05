<?php
namespace SmileLife\Card\Category\Acquisition\Travel;

use SmileLife\Card\CardType;
use SmileLife\Card\Category\Acquisition\Travel\Travel;
use SmileLife\Card\Module\BaseGame;

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
        return CardType::CARD_TYPE_TRAVEL_RIO;
    }

    public function getClass(): string {
        return self::class;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame is in Travel 
     * ---------------------------------------------------------------------- */
}
