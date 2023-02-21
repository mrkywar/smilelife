<?php
namespace SmileLife\Game\Card\Category\Reward;

use SmileLife\Game\Card\Category\Job\Job\Journalist;
use SmileLife\Game\Card\Category\Job\Job\Researcher;
use SmileLife\Game\Card\Category\Reward\Reward;
use SmileLife\Game\Card\Core\CardType;
use SmileLife\Game\Card\Core\Exception\CardException;
use SmileLife\Game\Card\Module\BaseGame;



/**
 * Description of NationalMedal
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class NationalMedal extends Reward implements BaseGame {

    public function __construct() {
        parent::__construct();

        $this->setTitle(clienttranslate('Grand Prize of Excellence'))
                ->setText1(clienttranslate('Can only be attributed to writers, '
                                . 'researchers and journalists'))
                ->setText2(clienttranslate('You may pocket paychecks from 1 to '
                                . '4 while you work in the awarded job.'));
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    public function canBeAttacked(): bool {
        return false;
    }

    public function canBePlayed(): bool {
        throw new CardException("C-ExcellenceReward-01 : check the rules !");
    }

    public function getClass(): string {
        return self::class;
    }

    public function getSmilePoints(): int {
        return 4;
    }

    /**
     * Get Compatible Classes (null = no restriction)
     * @return array|null
     */
    public function getCompatibleJobClasses(): ?array {
        return [
            Journalist::class,
            Researcher::class,
            Job\Author::class
        ];
    }

    /**
     * Get UnCompatible Classes (null = no restriction)
     * @return array|null
     */
    public function getUncompatibleJobClasses(): ?array {
        return null;
    }

    public function getType(): int {
        return CardType::REWARD_NATIONAL_MEDAL;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Implement BaseGame
     * ---------------------------------------------------------------------- */

    public function getBaseCardCount(): int {
        return 2;
    }

}
