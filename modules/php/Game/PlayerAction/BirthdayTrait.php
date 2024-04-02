<?php

namespace SmileLife\PlayerAction;

/**
 *
 * @author mrKywar
 */
trait BirthdayTrait {

//    public function argsBirthdayInit(): array {
//        return [];
//    }

    public function stBirthdayInit() {
        $actualPlayer = $this->getActualPlayer();
        $this->gamestate->setAllPlayersMultiactive();
        $this->gamestate->setPlayerNonMultiactive($actualPlayer->getId(),"nextPlayer");
    }
}
