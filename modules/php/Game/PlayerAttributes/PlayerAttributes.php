<?php

namespace SmileLife\PlayerAttributes;

use Core\Models\Core\Model;
use Core\Models\Player;
use SmileLife;

/**
 * Description of PlayerAttributes
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 * @ORM\Table{"name":"player_attributes"}
 */
class PlayerAttributes extends Model {

    /**
     * 
     * @var int|null
     * @ORM\Column{"type":"integer", "name":"attributes_player_id"}
     * @ORM\Id
     */
    private $id;

    /**
     * 
     * @var int
     * @ORM\Column{"type":"integer", "name":"attributes_max_cards"}
     * @ORM\Exclude{"insert":true}
     */
    private $maxCards;

    /**
     * 
     * @var int
     * @ORM\Column{"type":"integer", "name":"attributes_pass_turn"}
     * @ORM\Exclude{"insert":true}        
     */
    private $passTurn;

    /* -------------------------------------------------------------------------
     *                  BEGIN - Constructor
     * ---------------------------------------------------------------------- */

    public function __construct() {
        $this->maxCards = 5;
        $this->passTurn = 0;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Shortcut
     * ---------------------------------------------------------------------- */

    public function setPlayer(Player $player) {
        return $this->setId($player->getId());
    }

    public function getPlayer(): Player {
        return SmileLife::getInstance()
                        ->getPlayerManager()
                        ->findBy(["id" => $this->getId()]);
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Getters & Setters 
     * ---------------------------------------------------------------------- */

    public function getMaxCards(): int {
        return $this->maxCards;
    }

    public function setMaxCards(int $maxCards) {
        $this->maxCards = $maxCards;
        return $this;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function setId(?int $id) {
        $this->id = $id;
        return $this;
    }

    public function getPassTurn(): int {
        return $this->passTurn;
    }

    public function setPassTurn(int $passTurn) {
        $this->passTurn = $passTurn;
        return $this;
    }

}
