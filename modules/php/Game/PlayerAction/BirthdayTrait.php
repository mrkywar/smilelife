<?php

namespace SmileLife\PlayerAction;

use Core\Models\Player;
use SmileLife\Game\Request\OfferWageRequest;
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
    
    public function offerWage($cardId) {
        self::checkAction('offerWage');

        $player = $this->getActualPlayer();

        $card = $this->cardManager->findBy(["id" => $cardId]);
        if (null === $card) {
            throw new \BgaUserException("No card selected");
        }
        $request = new OfferWageRequest($player, $card);

        $response = $this->requester->send($request);

        $this->applyResponse($response);
    }
}
