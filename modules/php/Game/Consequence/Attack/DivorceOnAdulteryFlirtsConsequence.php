<?php

namespace SmileLife\Consequence\Attack;

use Core\Notification\Notification;
use Core\Requester\Response\Response;
use SmileLife\Card\CardManager;
use SmileLife\Consequence\Consequence;
use SmileLife\Card\Core\CardDecorator;
use SmileLife\Table\PlayerTable;
use SmileLife\Table\PlayerTableDecorator;
use SmileLife\Table\PlayerTableManager;

/**
 * Description of DivorceOnAdulteryFlirtsConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class DivorceOnAdulteryFlirtsConsequence extends Consequence {

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

        $cardsId = $table->getAdulteryFlirtIds();
        $flirts = $table->getAdulteryFlirts();
        foreach ($flirts as $flirt) {
            $flirt->setIsFlipped(true);
            $this->cardManager->update($flirt);
        }
        $table->resignAdultery();

        $this->tableManager->updateTable($table);

        $notificationFlirt = new Notification();

        $notificationFlirt->setType("flirtsAdultery")
                ->setText(clienttranslate('all the adulterous flirtations of ${player_name} are preserved'))
                ->add('player_name', $player->getName())
                ->add('playerId', $player->getId())
                ->add('cards', $this->cardDecorator->decorate($flirts))
        ;

        $response->addNotification($notificationFlirt);
    }

}
