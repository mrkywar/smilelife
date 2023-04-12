<?php

namespace SmileLife\Card\Category\Studies;

use SmileLife\Card\Card;
use SmileLife\Card\Core\Exception\CardException;
use SmileLife\Card\Effect\CardEffectInterface;
use SmileLife\Card\Effect\Category\LimitlessStudiesEffect;
use SmileLife\Game\Calculator\StudiesLevelCalculator;
use SmileLife\Table\PlayerTable;

/**
 * Description of Studies
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
abstract class Studies extends Card {

    private const SMILE_POINT = 1;

    /**
     * 
     * @var StudiesLevelCalculator
     */
    private $studiesLevelCalculator;

    public function __construct() {
        parent::__construct();

        $this->studiesLevelCalculator = new StudiesLevelCalculator();

        $this->setTitle(clienttranslate('Higher'))
                ->setText2(clienttranslate('Studies'));
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - new Abstract
     * ---------------------------------------------------------------------- */

    abstract public function getLevel(): int;
    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    public function canBeAttacked(): bool {
        return true;
    }

    public function canBePlayed(PlayerTable $table): bool {
        $job = $table->getJob();
        if ($job instanceof CardEffectInterface && $this->checkLimitlessStudies($job)) {
            $this->setIsFlipped(true);
            return true;
        } elseif (null !== $job) {
            throw new CardException(clienttranslate('You have an active Job'));
            return false;
        }
        $actualLevel = $this->studiesLevelCalculator->compute($table->getStudies());

        if ($actualLevel + $this->getLevel() > 6) {
//            clienttranslate('Level ${level}', ['level' => 2])
            throw new CardException(clienttranslate('You have already reached level ${level} of studies and you cannot exceed 6', ['level' => $actualLevel]));
        }

        return true;
    }

    private function checkLimitlessStudies(CardEffectInterface $job) {
        return ($job->getEffect() instanceof LimitlessStudiesEffect);
    }

    public function getSmilePoints(): int {
        return self::SMILE_POINT;
    }

    public function getCategory(): string {
        return "studies";
    }

    public function getPileName(): string {
        return 'job';
    }
    
    /* -------------------------------------------------------------------------
     *                  BEGIN - Display
     * ---------------------------------------------------------------------- */

    public function __toString() {
        return $this->getTitle()." ".$this->getText2();
    }

}
