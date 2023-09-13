<?php

namespace SmileLife\Game\Initializer\Test;

use SmileLife\Card\Category\Attack\BurnOut;
use SmileLife\Card\Category\Job\Official\Teacher\EnglishTeacher;
use SmileLife\Card\Category\Love\Flirt\Hotel;
use SmileLife\Card\Category\Studies\StudiesLevel1;
use SmileLife\Card\Core\CardLocation;
use SmileLife\Game\Initializer\GameInitializer;

/**
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class DiscardTestsInitializer extends GameInitializer {

    public function init($players, $options = []) {
        parent::init($players, $options);

        $job = new EnglishTeacher();
        $job->setLocation(CardLocation::DISCARD)
                ->setLocationArg(1);
        
        $burnOut = new BurnOut();
        $burnOut->setLocation(CardLocation::DISCARD)
                ->setLocationArg(2);
        
        $studie = new StudiesLevel1();
        $studie->setLocation(CardLocation::DISCARD)
                ->setLocationArg(3);
        
        $flirt = new Hotel();
        $flirt->setLocation(CardLocation::DISCARD)
                ->setLocationArg(4);
        
        
        $forcedDiscard = [$job, $burnOut, $flirt, $studie];
        $this->cardManager->add($forcedDiscard);

        $oTables = $this->playerTableManager->findBy();
        $i = random_int(0, count($oTables) - 1);
        $case1Table = $oTables[array_keys($oTables)[$i]];

        return $case1Table->getId();
    }

}
