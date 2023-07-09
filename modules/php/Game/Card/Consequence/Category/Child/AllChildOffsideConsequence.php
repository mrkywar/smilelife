<?php

namespace SmileLife\Card\Consequence\Category\Child;

use Core\Notification\Notification;
use Core\Requester\Response\Response;
use SmileLife\Card\CardManager;
use SmileLife\Card\Consequence\Consequence;
use SmileLife\Card\Core\CardDecorator;
use SmileLife\Table\PlayerTable;
use SmileLife\Table\PlayerTableManager;

/**
 * Description of AllChildOffsideConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class AllChildOffsideConsequence extends Consequence {

    /**
     * 
     * @var PlayerTableManager
     */
    private $tableManager;

    /**
     * 
     * @var CardManager
     */
    protected $cardManager;

    /**
     * 
     * @var CardDecorator
     */
    protected $cardDecorator;

    public function __construct() {
        $this->tableManager = new PlayerTableManager();
        $this->cardManager = new CardManager();
        $this->cardDecorator = new CardDecorator();
    }

    public function execute(Response &$response) {
        $tables = $this->tableManager->findBy();
        foreach ($tables as $table) {
            $this->offsideTableChilds($table);
        }
    }

    private function offsideTableChilds(PlayerTable &$table) {
        $childs = $table->getChilds();
        $ids = [];
        foreach ($childs as &$child) {
            $table->removeCard($child);
            $this->cardManager->offsideCard($this->card, $player);
            $ids[] = $child->getId();
        }
        if (!empty($ids)) {
            $notification = new Notification();
            $player = $this->table->getPlayer();

            $discardedCards = $this->cardManager->getAllCardsInDiscard();

            $notification->setType("offsideNotification")
                    ->setText(clienttranslate('${player_name} offside ${cardcount} child(s)'))
                    ->add('player_name', $player->getName())
                    ->add('playerId', $player->getId())
                    ->add('childs', $this->cardDecorator->decorate($childs))
                    ->add('cardcount', count($ids))
                    ->add('offside', $this->cardDecorator->decorate($discardedCards));
            ;
        }
    }

}
