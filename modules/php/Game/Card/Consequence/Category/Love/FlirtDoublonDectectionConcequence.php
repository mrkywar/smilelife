<?php

namespace SmileLife\Card\Consequence\Category\Love;

use Core\Notification\Notification;
use Core\Requester\Response\Response;
use SmileLife\Card\CardManager;
use SmileLife\Card\Category\Love\Flirt\Flirt;
use SmileLife\Card\Consequence\Consequence;
use SmileLife\Card\Core\CardDecorator;
use SmileLife\Table\PlayerTable;
use SmileLife\Table\PlayerTableManager;

/**
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class FlirtDoublonDectectionConcequence extends Consequence {

    /**
     * 
     * @var Flirt
     */
    private $card;

    /**
     * 
     * @var PlayerTable
     */
    private $table;

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
        $this->tableManager = new PlayerTableManager();
        $this->cardDecorator = new CardDecorator();
        $this->cardManager = new CardManager();
        $this->table = $table;
        $this->card = &$card;
    }

    public function execute(Response &$response) {
        $tables = $this->tableManager->findBy();
        $doublon = null;
        $targetTable = null;

        foreach ($tables as $table) {
            if ($table->getId() !== $this->table->getId()) {
                $doublon = $this->checkTableDoublonFlirt($table);
                $targetTable = $table;
            }
        }
//        var_dump($doublon);die;

        if (null !== $doublon && null !== $targetTable) {
            $player = $this->table->getPlayer();
            $targetPlayer = $targetTable->getPlayer();
            
            $notification = new Notification();
            $notification->setType("doublonFlirt_notification")
                    ->setText(clienttranslate('${player_name} steal ${cardName} to ${target_name}'))
                    ->add('player_name', $player->getName())
                    ->add('playerId', $player->getId())
                    ->add('target_name',$targetPlayer->getName())
                    ->add('cardName',$doublon->getName())
                    ->add('card', $this->cardDecorator->decorate($doublon));
            
            $response->addNotification($notification);

            $this->card->setLocationArg($player->getId());
            $this->cardManager->playCard($player, $this->card);

            $this->table->addCard($this->card);
            $this->tableManager->updateTable($this->table);
        }
    }

    private function checkTableDoublonFlirt(PlayerTable $table): ?Flirt {
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

}
