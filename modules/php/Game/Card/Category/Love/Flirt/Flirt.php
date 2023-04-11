<?php

namespace SmileLife\Card\Category\Love\Flirt;

use SmileLife\Card\Category\Love\Love;
use SmileLife\Card\Core\Exception\CardException;
use SmileLife\Card\Effect\CardEffectInterface;
use SmileLife\Card\Effect\Category\LimitlessFlirt;
use SmileLife\Table\PlayerTable;

/**
 * Description of Flirt
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
abstract class Flirt extends Love {

    private const SMILE_POINTS = 1;

    /**
     * 
     * @var string
     */
    private $pileName;

    public function __construct() {
        parent::__construct();
        $this->pileName = "love";

        $this->setTitle(clienttranslate('Flirt'));

        if ($this->canGenerateChild()) {
            $this->setText2(clienttranslate('Possibility to have a child'));
        }
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    public function canBeAttacked(): bool {
        return false;
    }

    public function canBePlayed(PlayerTable $table): bool {
        $job = $table->getJob();
        if (null !== $table->getAdultery()) {
            $this->setPileName("adultery");
            return true;
        } elseif ($job instanceof CardEffectInterface && $this->checkLimitlessFlirt($job)) {
            return true;
        } elseif (count($table->getFlirts()) < 5) {
            return true;
        }

        throw new CardException(clienttranslate('You have already done ${number} flirts 5', ['number' => count($table->getFlirts())]));
    }

    private function checkLimitlessFlirt(CardEffectInterface $job) {
        return ($job->getEffect() instanceof LimitlessFlirt);
    }

    public function getSmilePoints(): int {
        return self::SMILE_POINTS;
    }

    public function getCategory(): string {
        return "flirt";
    }

    public function getPileName(): string {
        return $this->pileName;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Getters & Setters
     * ---------------------------------------------------------------------- */

    public function setPileName(string $pileName) {
        $this->pileName = $pileName;
        return $this;
    }

}
