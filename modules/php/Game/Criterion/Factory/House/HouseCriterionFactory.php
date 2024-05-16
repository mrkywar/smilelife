<?php

namespace SmileLife\Criterion\Factory\House;

use SmileLife\Card\Acquisition\House\House;
use SmileLife\Card\Card;
use SmileLife\Card\Criterion\Factory\Category\CardPlayableCriterionFactory;
use SmileLife\Card\Job\Job\Architect;
use SmileLife\Consequence\Generic\GenericCardPlayedConsequence;
use SmileLife\Consequence\Job\JobUsedConsequence;
use SmileLife\Consequence\Wage\WagesSpentConsequence;
use SmileLife\Criterion\Card\Love\IsMarriedCriterion;
use SmileLife\Criterion\CriterionInterface;
use SmileLife\Criterion\InversedCriterion;
use SmileLife\Criterion\NullCriterion;
use SmileLife\Criterion\Wage\HaveEnouthWageToBuyCriterion;
use SmileLife\Table\PlayerTable;

/**
 * Description of HouseCriterionFactory
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class HouseCriterionFactory extends CardPlayableCriterionFactory {

    /**
     * 
     * @param PlayerTable $table : Game table of the player who plays
     * @param Card $card : The card that is played
     * @param PlayerTable $opponentTable : Game table of player targeted by attack (useless here)
     * @param Card[] $complementaryCards : Other cards chosen as part of purchase by example(useless here)
     * @return CriterionInterface
     */
    public function getCardCriterion(PlayerTable $table, Card $card, PlayerTable $opponentTable = null, array $complementaryCards = null): CriterionInterface {
        $isMarried = new IsMarriedCriterion($table);
        $initialPrice = $this->retriveInitialPrice($card);
        $priceReduction = ($isMarried->isValided()) ? 0.5 : null;
        $architect = $this->retriveGivenArchitect($complementaryCards);

        if (is_array($complementaryCards) && !empty($complementaryCards) && null === $architect) {
            $criterion = new HaveEnouthWageToBuyCriterion($table, $card, $complementaryCards, $priceReduction);
            $criterion->setErrorMessage(clienttranslate('You have not chosen the sufficient salary amount'))
                    ->addConsequence(new GenericCardPlayedConsequence($card, $table))
                    ->addConsequence(new WagesSpentConsequence($table, $complementaryCards));
        } elseif (null !== $architect) {
            $criterion = new NullCriterion();
            $criterion->addConsequence(new GenericCardPlayedConsequence($card, $table))
                    ->addConsequence(new JobUsedConsequence($architect, $table));
        } else {
            // not possible to valid a complementary card is required !
            $criterion = new InversedCriterion(new NullCriterion());
            $criterion->setErrorMessage(clienttranslate('You have not chosen the sufficient salary amount'));
        }

        return $criterion;
    }

    private function retriveGivenArchitect(array $complementaryCards = null): ?Architect {
        foreach ($complementaryCards as $givenCard) {
            if ($givenCard instanceof Architect) {
                return $givenCard;
            }
        }
        return null;
    }

    private function retriveInitialPrice(House $card) {
        return $card->getPrice();
    }
}
