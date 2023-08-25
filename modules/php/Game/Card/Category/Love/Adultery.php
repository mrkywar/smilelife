<?php

namespace SmileLife\Card\Category\Love;

use SmileLife\Card\Card;
use SmileLife\Card\CardType;
use SmileLife\Card\Core\CardPile;
use SmileLife\Card\Criterion\Factory\CardCriterionFactory;
use SmileLife\Card\Criterion\Factory\Category\Love\AdulteryCriterionFactory;
use SmileLife\Card\Module\BaseGame;

/**
 * Description of Adultery
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class Adultery extends Card implements BaseGame {

    private const SMILE_POINTS = 1;

    public function __construct() {
        parent::__construct();

        $this->setTitle(clienttranslate('Adultery'))
                ->setText1(clienttranslate('Flirt while married while you keep '
                                . 'this card put down. Loss of children in the '
                                . 'case of divorce.'));
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    public function getClass(): string {
        return self::class;
    }

    public function getSmilePoints(): int {
        return self::SMILE_POINTS;
    }

    public function getType(): int {
        return CardType::ADULTERY;
    }

    public function getCategory(): string {
        return "adultery";
    }

    public function getPileName(): string {
        return CardPile::PILE_ADULTERY;
    }

    public function getCriterionFactory(): CardCriterionFactory {
        return new AdulteryCriterionFactory();
    }
    
    public function getDefaultPassTurn(): int {
        return 0;
    }
    
    public function getAdditionalsDatas(): ?array {
        return null;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame
     * ---------------------------------------------------------------------- */

    public function getBaseCardCount(): int {
        return 3;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Display
     * ---------------------------------------------------------------------- */

    public function __toString() {
        return $this->getTitle();
    }

}
