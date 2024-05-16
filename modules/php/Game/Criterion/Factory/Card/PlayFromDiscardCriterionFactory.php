<?php

namespace SmileLife\Criterion\Factory\Card;

use SmileLife\Card\Card;
use SmileLife\Card\Criterion\Factory\Category\CardPlayableCriterionFactory;
use SmileLife\Card\Special\ShootingStar;
use SmileLife\Consequence\Generic\GenericCardPlayedConsequence;
use SmileLife\Criterion\CriterionGroup;
use SmileLife\Criterion\CriterionInterface;
use SmileLife\Criterion\InversedCriterion;
use SmileLife\Criterion\NullCriterion;
use SmileLife\Table\PlayerTable;

/**
 * Description of PlayFromDiscardCriterionFactory
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class PlayFromDiscardCriterionFactory extends CardPlayableCriterionFactory {

    /**
     * 
     * @param PlayerTable $table : Game table of the player who plays
     * @param Card $card : The card that is played
     * @param PlayerTable $opponentTable : Game table of player targeted by attack (useless here)
     * @param Card[] $complementaryCards : Other cards chosen as part of purchase by example(useless here)
     * @return CriterionInterface
     */
    public function getCardCriterion(PlayerTable $table, Card $card, PlayerTable $opponentTable = null, array $complementaryCards = null): CriterionInterface {
        $criterion = new NullCriterion();

        if (empty($complementaryCards)) {
            // No complementary card given
            if ($this->isComplementaryCardsMendatory($card)) {
                // CASE : Shooting star require a card 
                // not possible to valid a complementary card is required !
                $invalidedCriterion = new InversedCriterion(new NullCriterion());
                $criteria = new CriterionGroup([
                    $criterion,
                    $invalidedCriterion
                        ], CriterionGroup::AND_OPERATOR);
                $criteria->setErrorMessage(clienttranslate('no card selected'));
                return $criteria;
            } else {
                // CASE : Astronaut not require a complementary card (and player have accept it)
                return $criterion;
            }
        } else {
            for ($i = 0; $i < sizeof($complementaryCards); $i++) {
                $complementaryCard = $complementaryCards[$i];
                $newComplementaryCard = null;
                $factory = $this->getComplemataryCardCriterionFactory($complementaryCard);
                if (isset($complementaryCards[$i + 1])) {
                    // the next Complementary card should be for the active 
                    $newComplementaryCard = [$complementaryCards[$i + 1]];
                }

                $subCriterion = $factory->create($table, $complementaryCard, $opponentTable, $newComplementaryCard);
                $subCriterion->setErrorMessage(clienttranslate('the chosen card cannot be played'));

                $criterion = new CriterionGroup([
                    $criterion,
                    $subCriterion
                        ], CriterionGroup::AND_OPERATOR);
            }

            $criterion
                    ->addConsequence(new GenericCardPlayedConsequence($card, $table));

            return $criterion;
        }
    }

    private function isComplementaryCardsMendatory(Card $card) {
        return ($card instanceof ShootingStar);
    }

    private function getComplemataryCardCriterionFactory(Card $card): CardCriterionFactory {
        return $card->getCriterionFactory();
    }
}
