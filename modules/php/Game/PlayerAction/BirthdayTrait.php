<?php

namespace SmileLife\PlayerAction;

use Core\Models\Player;
use SmileLife\Table\PlayerTable;

/**
 *
 * @author mrKywar
 */
trait BirthdayTrait {


    public function stBirthdayInit() {
        $actualPlayer = $this->getActualPlayer();
        $this->gamestate->setAllPlayersMultiactive();
        $this->gamestate->setPlayerNonMultiactive($actualPlayer->getId(), "nextPlayer");

        $allPlayersTable = $this->tableManager->findBy();
        foreach ($allPlayersTable as $table) {
            if (!$this->canBeTargetedByBirthday($actualPlayer, $table)) {
                $this->gamestate->setPlayerNonMultiactive($table->getId(), "nextPlayer");
            }
        }
    }

    private function canBeTargetedByBirthday(Player $activePlayer, PlayerTable $table) {
        $wages = $table->getAviableWages();
        return (!empty($wages) && $activePlayer->getId() !== $table->getId());
    }
}
