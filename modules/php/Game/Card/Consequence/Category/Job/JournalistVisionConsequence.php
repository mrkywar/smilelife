<?php

namespace SmileLife\Card\Consequence\Category\Job;

use Core\Models\Player;
use Core\Notification\Notification;
use Core\Requester\Response\Response;
use SmileLife\Card\CardManager;
use SmileLife\Card\Category\Job\Job\Journalist;
use SmileLife\Card\Consequence\PlayerTableConsequence;
use SmileLife\Card\Core\CardDecorator;
use SmileLife\Table\PlayerTable;
use SmileLife\Table\PlayerTableManager;

/**
 * Description of JournalistVisionConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class JournalistVisionConsequence extends PlayerTableConsequence {

    /**
     * 
     * @var Journalist
     */
    private $job;

    /**
     * 
     * @var CardManager
     */
    private $cardManager;

    /**
     * 
     * @var PlayerManager;
     */
    private $playerManager;

    /**
     * 
     * @var CardDecorator
     */
    private $cardDecorator;

    public function __construct(Journalist $card, PlayerTable $table) {
        parent::__construct($table);

        $this->job = $card;
        $this->cardManager = new CardManager();
        $this->cardDecorator = new CardDecorator();
        $this->$playerManager = new PlayerTableManager();
    }

    public function execute(Response &$response) {
        $activePlayer = $this->table->getPlayer();
        foreach ($this->$playerManager->findBy() as $targetPlayer) {
            if ($activePlayer->getId() !== $targetPlayer->getId()) {
                $response->addNotification($this->generateNotification($activePlayer, $targetPlayer));
            }
        }

        return $response;
    }

    private function generateNotification(Player $player, Player $targetPlayer): Notification {
        $cards = $this->cardManager->getPlayerCards($targetPlayer);

        $notification = new Notification();
        $notification->setType("showCardsNotification")
                ->setText(clienttranslate('${player_name} show his hand cards to ${player_name2}'))
                ->add('player_name', $targetPlayer->getName())
                ->add('player_name2', $player->getName())
                ->add('playerId', $player->getId())
                ->add('cards', $this->cardDecorator->decorate($cards));

        return $notification;
    }

}
