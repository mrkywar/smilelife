<?php

namespace SmileLife\Game;

use Core\Models\Core\Model;

/**
 * Description of Game
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */

/**
 * Description of Player
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 * @ORM\Table{"name":"game"}
 */
class Game extends Model {

    /**
     * 
     * @var int
     * @ORM\Column{"type":"integer", "name":"game_id"}
     * @ORM\Id
     */
    private $id;

    /**
     * 
     * @var array
     * @ORM\Column{"type":"json", "name":"game_option"}
     */
    private $options;

    /**
     * 
     * @var float
     * @ORM\Column{"type":"float", "name":"game_aviable_cards", "exclude":["insert"]}
     */
    private $aviableCards;

    /* -------------------------------------------------------------------------
     *                  BEGIN - Getters & Setters 
     * ---------------------------------------------------------------------- */

    public function getId(): int {
        return $this->id;
    }

    public function getOptions(): array {
        return $this->options;
    }

    public function setId(int $id) {
        $this->id = $id;
        return $this;
    }

    public function setOptions(array $options) {
        $this->options = $options;
        return $this;
    }

    public function getAviableCards(): float {
        return $this->aviableCards;
    }

    public function setAviableCards(float $aviableCards) {
        $this->aviableCards = $aviableCards;
        return $this;
    }

}
