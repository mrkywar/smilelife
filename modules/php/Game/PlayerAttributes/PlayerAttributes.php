<?php

namespace SmileLife\Game\PlayerAttributes;

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
     * @ORM\Exclude{"insert":true,"update":true}
     */
    private $maxCards;

    /* -------------------------------------------------------------------------
     *                  BEGIN - Constructor
     * ---------------------------------------------------------------------- */

    public function __construct() {
        $this->maxCards = 5;
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

}
