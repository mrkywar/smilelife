<?php

namespace SmileLife\Card\Criterion\Factory\Category\Special;

use SmileLife\Card\Card;
use SmileLife\Card\Consequence\Category\Generic\GenericCardPlayedConsequence;
use SmileLife\Card\Criterion\CriterionInterface;
use SmileLife\Card\Criterion\Factory\CardCriterionFactory;
use SmileLife\Card\Criterion\Factory\Category\NullCriterionFactory;
use SmileLife\Card\Criterion\GenericCriterion\CriterionGroup;
use SmileLife\Card\Criterion\GenericCriterion\InversedCriterion;
use SmileLife\Card\Criterion\GenericCriterion\NullCriterion;
use SmileLife\Table\PlayerTable;
use SmileLife\Table\PlayerTableManager;

/**
 * Description of RevengeCriterionFactory
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class RevengeCriterionFactory extends NullCriterionFactory {
    
    

    /**
     * 
     * @param PlayerTable $table : Game table of the player who plays
     * @param Card $card : The card that is played
     * @param PlayerTable $opponentTable : Game table of player targeted by attack (useless here)
     * @param Card[] $complementaryCards : Other cards chosen as part of purchase by example(useless here)
     * @return CriterionInterface
     */
    public function create(PlayerTable $table, Card $card, PlayerTable $opponentTable = null, array $complementaryCards = null): CriterionInterface {
        $criterion = parent::create($table, $card, $opponentTable, $complementaryCards);

        if (empty($complementaryCards) || null === $complementaryCards[0]) {
            // not possible to valid a complementary card is required !
            $invalidedCriterion = new InversedCriterion(new NullCriterion());
            $criteria = new CriterionGroup([
                $criterion,
                $invalidedCriterion
                    ], CriterionGroup::AND_OPERATOR);
            $criteria->setErrorMessage(clienttranslate('no card selected'));

            return $criteria;
        } else if (sizeof($complementaryCards) > 1) {
            // not possible to valid only one complementary card is required !
            $invalidedCriterion = new InversedCriterion(new NullCriterion());
            
            $criteria = new CriterionGroup([
                $criterion,
                $invalidedCriterion
                    ], CriterionGroup::AND_OPERATOR);
            $criteria->setErrorMessage(clienttranslate('invalid selection'));

            return $criteria;
        } else {
            $factory = $this->getComplemataryCardCriterionFactory($complementaryCards[0]);
            
            $subCriterion = $factory->create($table, $complementaryCards[0], $opponentTable);
            $subCriterion->setErrorMessage(clienttranslate('the chosen card cannot be played'));
            
            $table->removeAttack($complementaryCards[0]);
            $tableManager = new PlayerTableManager();
            $tableManager->update($table);

            $criterion->addConsequence(new GenericCardPlayedConsequence($card, $table));

            return new CriterionGroup([
                $criterion,
                $subCriterion
                    ], CriterionGroup::AND_OPERATOR);
            
//            var_dump($table->getPlayer(), $opponentTable->getPlayer());
//            die;
//            for ($i = 0; $i < sizeof($complementaryCards); $i++) {
//                $complementaryCard = $complementaryCards[$i];
//                $newComplementaryCard = null;
//                $factory = $this->getComplemataryCardCriterionFactory($complementaryCard);
//                if (isset($complementaryCards[$i + 1])) {
//                    // the next Complementary card should be for the active 
//                    $newComplementaryCard = [$complementaryCards[$i + 1]];
//                }
//
//                $subCriterion = $factory->create($table, $complementaryCard, $opponentTable, $newComplementaryCard);
//                $subCriterion->setErrorMessage(clienttranslate('the chosen card cannot be played'));
//
//                $criterion = new CriterionGroup([
//                    $criterion,
//                    $subCriterion
//                        ], CriterionGroup::AND_OPERATOR);
//            }
//
//            $criterion
//                    ->addConsequence(new GenericCardPlayedConsequence($card, $table));
//
//            return $criterion;
//            $factory = $this->getComplemataryCardCriterionFactory($complementaryCards[0]);
//
//            $subCriterion = $factory->create($table, $complementaryCards[0], $opponentTable);
//            $subCriterion->setErrorMessage(clienttranslate('the chosen card cannot be played'));
//
//            if ($complementaryCards[0] instanceof Attack) {
//                $criterion
//                        ->addConsequence(new GenericAttackPlayedConsequence($complementaryCards[0], $table, $opponentTable));
//            } else {
//                $criterion
//                        ->addConsequence(new GenericCardPlayedConsequence($complementaryCards[0], $table));
//            }
//            $criterion
//                        ->addConsequence(new GenericCardPlayedConsequence($card, $table));
//
//            return new CriterionGroup([
//                $criterion,
//                $subCriterion
//                    ], CriterionGroup::AND_OPERATOR);
        }
    }

    private function getComplemataryCardCriterionFactory(Card $card): CardCriterionFactory {
        return $card->getCriterionFactory();
    }
}
