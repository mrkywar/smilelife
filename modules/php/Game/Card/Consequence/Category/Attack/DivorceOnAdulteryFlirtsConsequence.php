<?php

namespace SmileLife\Card\Consequence\Category\Attack;

use Core\Requester\Response\Response;
use SmileLife\Card\Consequence\Consequence;
use SmileLife\Card\Consequence\ConsequenceException;
use SmileLife\Table\PlayerTable;

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

    public function __construct(PlayerTable $table) {
        $this->table = $table;
    }

    public function execute(Response &$response) {
        $flirts = $this->table->getAdulteryFlirts();
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
                ->add('table', $this->tableDecorator->decorate($table))
        ;

        $response->addNotification($notificationFlirt);
    }

}
