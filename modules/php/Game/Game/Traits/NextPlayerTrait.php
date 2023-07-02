<?php

namespace SmileLife\Game\Traits;

use Core\Notification\Notification;
use SmileLife\Card\Category\Attack\Attack;
use SmileLife\Card\Core\CardDecorator;
use SmileLife\Table\PlayerTable;
use SmileLife\Table\PlayerTableDecorator;

/**
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
trait NextPlayerTrait {

    public function stNextPlayer() {

        $playerId = intval($this->getActivePlayerId());

        $this->giveExtraTime($playerId);

        $newPlayerId = $this->activeNextPlayer();

        $playerTable = $this->tableManager->findBy(["id" => $newPlayerId]);

        $passCard = $this->getLastActivePassTurn($playerTable);
        if (null !== $passCard) {
            $tableDecorator = new PlayerTableDecorator();
            $cardDecorator = new CardDecorator();
            $player = $playerTable->getPlayer();

            $passCard->setPassTurn($passCard->getPassTurn() - 1);
            if ($passCard->getPassTurn() < 1) {
                $passCard->setIsUsed(true)
                        ->setIsFlipped(true);
            }
            $this->cardManager->update($passCard);

            $discardedCards = $this->cardManager->getAllCardsInDiscard();

            $notification = new Notification();
            $notification->setType("turnpassNotification")
                    ->setText(clienttranslate('${player_name} misses a turn because of the ${card} card '))
                    ->add('player_name', $player->getName())
                    ->add('playerId', $player->getId())
                    ->add('card', (string) $passCard)
                    ->add('table', $tableDecorator->decorate($playerTable))
                    ->add('discard', $cardDecorator->decorate($discardedCards));
            ;           

            $this->gamestate->nextState("playerPass");
            $this->sendNotification($notification);
        } else {
            $this->gamestate->nextState("newTurn");
        }
    }

    private function getLastActivePassTurn(PlayerTable $table): ?Attack {
        $attacks = $table->getAttacks();

        foreach ($attacks as $attack) {
            if ($attack->getPassTurn() > 0) {
                return $attack;
            }
        }

        return null;
    }

}
