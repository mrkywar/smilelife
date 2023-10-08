<?php

namespace SmileLife\Card\Consequence\Category\Attack;

use Core\Notification\Notification;
use Core\Requester\Response\Response;
use SmileLife\Card\CardManager;
use SmileLife\Card\Consequence\Consequence;
use SmileLife\Card\Core\CardDecorator;
use SmileLife\Table\PlayerTable;
use SmileLife\Table\PlayerTableDecorator;
use SmileLife\Table\PlayerTableManager;

/**
 * Description of DivorceOnAdulteryChildsConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class DivorceOnAdulteryChildsConsequence extends Consequence {

    /**
     * 
     * @var PlayerTable
     */
    private PlayerTable $table;

    /**
     * 
     * @var CardManager
     */
    private CardManager $cardManager;

    /**
     * 
     * @var PlayerTableManager
     */
    private PlayerTableManager $tableManager;

    /**
     * 
     * @var CardDecorator
     */
    private CardDecorator $cardDecorator;

    public function __construct(PlayerTable $table) {
        $this->table = $table;
        $this->cardManager = new CardManager();
        $this->tableManager = new PlayerTableManager();
        $this->cardDecorator = new CardDecorator();
    }

    public function execute(Response &$response) {
        $table = $this->table;
        $player = $table->getPlayer();

        $cardsId = $table->getChildIds();
        $childs = $table->getChilds();
        foreach ($childs as $child) {
            $table->removeCard($child);
        }

        $this->tableManager->updateTable($table);

        $notificationChild = new Notification();

        $notificationChild->setType("childsAdultery")
                ->setText(clienttranslate(' ${player_name} loses ${count} children for cheating'))
                ->add('player_name', $player->getName())
                ->add('playerId', $player->getId())
                ->add('count', count($cardsId))
        ;

        $response->addNotification($notificationChild);
    }

}
