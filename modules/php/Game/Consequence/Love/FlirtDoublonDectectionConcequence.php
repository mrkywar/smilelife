<?php

namespace SmileLife\Consequence\Love;

use Core\Models\Player;
use Core\Notification\Notification;
use Core\Requester\Response\Response;
use SmileLife\Card\CardManager;
use SmileLife\Card\Core\CardDecorator;
use SmileLife\Card\Core\CardPile;
use SmileLife\Card\Love\Flirt\Flirt;
use SmileLife\Consequence\PlayerTableConsequence;
use SmileLife\Table\PlayerTable;
use SmileLife\Table\PlayerTableManager;

/**
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class FlirtDoublonDectectionConcequence extends PlayerTableConsequence {

    /**
     * 
     * @var Flirt
     */
    private $card;

    /**
     * 
     * @var CardManager
     */
    private $cardManager;

    /**
     * 
     * @var PlayerTableManager
     */
    private $tableManager;

    /**
     * 
     * @var CardDecorator
     */
    private $cardDecorator;

    public function __construct(Flirt &$card, PlayerTable $table) {
        parent::__construct($table);

        $this->tableManager = new PlayerTableManager();
        $this->cardDecorator = new CardDecorator();
        $this->cardManager = new CardManager();
        $this->card = &$card;
    }

    public function execute(Response &$response) {
        $tables = $this->tableManager->findBy();
        $doublon = null;
        $targetTable = null;

        foreach ($tables as $table) {
            if ($table->getId() !== $this->table->getId() && null === $doublon) {
                $doublon = $this->checkTableDoublonFlirt($table);

                $targetTable = $table;
            }
        }

        if (null !== $doublon) {
            $player = $this->table->getPlayer();
            $targetPlayer = $targetTable->getPlayer();

            $this->moveDoublon($doublon, $this->table, $player);

            $notification = new Notification();
            $notification->setType("doublonFlirtNotification")
                    ->setText(clienttranslate('${player_name} steal ${cardName} to ${target_name}'))
                    ->add('player_name', $player->getName())
                    ->add('playerId', $player->getId())
                    ->add('target_name', $targetPlayer->getName())
                    ->add('targetId', $targetPlayer->getId())
                    ->add('cardName', $doublon->getName())
                    ->add('card', $this->cardDecorator->decorate($doublon));

            $response->addNotification($notification);

            $targetTable->removeCard($doublon);
            $this->tableManager->updateTable($targetTable);

            $this->card->setLocationArg($player->getId());
            $this->table->addCard($doublon);
            $this->tableManager->updateTable($this->table);
        }
    }

    private function checkTableDoublonFlirt(PlayerTable $table): ?Flirt {
        if (null !== $table->getMarriage()) {
            return null;
        }
        $classic = $this->getDoublonFlirt($table->getLastFlirt());
        if (null !== $classic) {
            return $classic;
        }
        return $this->getDoublonFlirt($table->getLastAdulteryFlirt());
    }

    private function getDoublonFlirt(?Flirt $flirt) {
        // The player have a last Flirt 
        // AND Flirt the same type as the played Flirt
        // AND Flirt isn't protected
        if (null !== $flirt && $flirt->getType() === $this->card->getType() && !$flirt->getIsFlipped()) {
            return $flirt;
        }
        return null;
    }

    private function moveDoublon(Flirt &$doublon, PlayerTable $targetTable, Player $player) {
        $doublon->setLocationArg($player->getId());
        if (null !== $targetTable->getAdultery()) {
            $doublon->setLocation(CardPile::PILE_ADULTERY)
                    ->setPileName(CardPile::PILE_ADULTERY);
        }
        $this->cardManager->update($doublon);
    }
}
