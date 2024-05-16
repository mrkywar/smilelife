<?php

namespace SmileLife\Game\Initializer\Test;

use SmileLife\Card\Attack\HumanAttack;
use SmileLife\Card\Child\Diana;
use SmileLife\Card\Child\Hermione;
use SmileLife\Card\Child\Zelda;
use SmileLife\Card\Core\CardLocation;
use SmileLife\Card\Job\Official\Military;
use SmileLife\Table\PlayerTable;

/**
 * Description of AttentatTestInitializer
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class AttentatTestInitializer extends TestGameInitializer {

    public function init($players, $options = []) {
        parent::init($players, $options);

        $oTables = $this->playerTableManager->findBy();

        $forcedCards = [];
        foreach ($oTables as $oTable) {
            $card = new HumanAttack();
            $card->setLocation(CardLocation::PLAYER_HAND)
                    ->setLocationArg($oTable->getId());
            $forcedCards[] = $card;
        }
        $this->cardManager->add($forcedCards);

        reset($oTables);

//        $casesGroup = rand(2, 4);
        $casesGroup = 4;

        switch ($casesGroup) {
            //----------------------------------- Groupe 1 : No Childs
            case 1:
                //-- case1 : No Child (not playable) (nothing to do)
                $i = random_int(0, count($oTables) - 1);
                $case1Table = $oTables[array_keys($oTables)[$i]];

                return $case1Table->getId();
                break;

            //----------------------------------- Groupe 2 : One or More Childs
            case 2:
                //-- case2 : One Child (playable)
                $i = random_int(0, count($oTables) - 1);
                $case2Table = $oTables[array_keys($oTables)[$i]];
                unset($oTables[$i]);
                $this->OneOrMoreChildCase($case2Table);

                return $case2Table->getId();
                break;
            //----------------------------------- Groupe 3 : One Child for each
            case 3:
                //-- case3 : One Child foreach player (playable)
                foreach ($oTables as $oTable) {
                    $this->OneOrMoreChildCase($oTable);
                }

                $i = random_int(0, count($oTables) - 1);
                $case3Table = $oTables[array_keys($oTables)[$i]];

                return $case3Table->getId();
                break;
            //----------------------------------- Groupe 4 : immunity
            case 4:
                //-- case4 : One Child but immunity in game (not playable)
                $i = random_int(0, count($oTables) - 1);
                $case4Table = $oTables[array_keys($oTables)[$i]];
                unset($oTables[$i]);
                $this->immuneCase($case4Table);

                return $case4Table->getId();
                break;
            default:
                die("Unsupported Case $casesGroup");
        }
    }

//
    private function OneOrMoreChildCase(PlayerTable $table) {
        $forcedChild = new Hermione();
        $forcedChild->setLocation(CardLocation::PLAYER_BOARD)
                ->setLocationArg($table->getId());

        $forcedChild2 = new Diana();
        $forcedChild2->setLocation(CardLocation::PLAYER_BOARD)
                ->setLocationArg($table->getId());

        $this->cardManager->add([$forcedChild, $forcedChild2]);

        $this->playWaitingCards($table);
    }

    private function immuneCase(PlayerTable $table) {
        $forcedCard = new Military();
        $forcedCard->setLocation(CardLocation::PLAYER_BOARD)
                ->setLocationArg($table->getId());

        $forcedChild = new Zelda();
        $forcedChild->setLocation(CardLocation::PLAYER_BOARD)
                ->setLocationArg($table->getId());

        $this->cardManager->add([$forcedCard, $forcedChild]);

        $this->playWaitingCards($table);
    }
}
