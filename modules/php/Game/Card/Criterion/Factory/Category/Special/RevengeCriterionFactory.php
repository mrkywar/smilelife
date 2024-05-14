<?php

namespace SmileLife\Card\Criterion\Factory\Category\Special;

use SmileLife\Card\Card;
use SmileLife\Consequence\Category\Generic\GenericCardPlayedConsequence;
use SmileLife\Card\Criterion\CriterionInterface;
use SmileLife\Card\Criterion\Factory\CardCriterionFactory;
use SmileLife\Card\Criterion\Factory\Category\CardPlayableCriterionFactory;
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
class RevengeCriterionFactory extends CardPlayableCriterionFactory {
    
    

    /**
     * 
     * @param PlayerTable $table : Game table of the player who plays
     * @param Card $card : The card that is played
     * @param PlayerTable $opponentTable : Game table of player targeted by attack (useless here)
     * @param Card[] $complementaryCards : Other cards chosen as part of purchase by example(useless here)
     * @return CriterionInterface
     */
     public function getCardCriterion(PlayerTable $table, Card $card, PlayerTable $opponentTable = null, array $complementaryCards = null): CriterionInterface {
         
        if (empty($complementaryCards) || null === $complementaryCards[0] || sizeof($complementaryCards) > 1) {
            // not possible to valid only one complementary card is required !
            $criteria = new InversedCriterion(new NullCriterion());
            
            $criteria->setErrorMessage(clienttranslate('invalid selection'));

            return $criteria;
        } else {
            $factory = $this->getComplemataryCardCriterionFactory($complementaryCards[0]);
            
            $subCriterion = $factory->getCardCriterion($table, $complementaryCards[0], $opponentTable);
            $subCriterion->setErrorMessage(clienttranslate('the chosen card cannot be played'));
            
            $table->removeAttack($complementaryCards[0]);
            $tableManager = new PlayerTableManager();
            $tableManager->update($table);

            $subCriterion->addConsequence(new GenericCardPlayedConsequence($card, $table));

            return $subCriterion;
            
        }
    }

    private function getComplemataryCardCriterionFactory(Card $card): CardCriterionFactory {
        return $card->getCriterionFactory();
    }
}
