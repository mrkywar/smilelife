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
        $vision = [];
        foreach ($this->$playerManager->findBy() as $targetPlayer) {
            if ($activePlayer->getId() !== $targetPlayer->getId()) {
                $cards = $this->cardManager->getPlayerCards($targetPlayer);
                $vision[$targetPlayer->getId()] = $this->cardDecorator->decorate($cards);
//                $response->addNotification($this->generateNotification($activePlayer, $targetPlayer));
            }
        }

        $notification = new Notification();
        $notification->setType("showPlayerCardsNotification")
                ->setText(clienttranslate('${player_name} show all player\'s hands cards'))
                ->add('player_name', $player->getName())
                ->add('playerId', $player->getId())
                ->add('vision', $vision);

        $response->addNotification($notification);

        return $response;
    }

}
