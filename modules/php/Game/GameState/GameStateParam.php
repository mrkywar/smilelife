<?php

namespace SmileLife\Game\GameState;

use Core\Models\Core\Model;

/**
 * Description of GameStateParam
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 * @ORM\Table{"name":"gamestate_param"}
 */
class GameStateParam extends Model {

    /**
     * 
     * @var int
     * @ORM\Column{"type":"integer", "name":"gamestate_param_id"}
     * @ORM\Id
     */
    private $id;

    /**
     * 
     * @var string
     * @ORM\Column{"type":"string", "name":"gamestate_param_label"}
     */
    private $label;

    /**
     * 
     * @var string
     * @ORM\Column{"type":"string", "name":"gamestate_param_value"}
     */
    private $value;

    /* -------------------------------------------------------------------------
     *                  BEGIN - Getters & Setters 
     * ---------------------------------------------------------------------- */

    public function getId(): int {
        return $this->id;
    }

    public function getLabel(): string {
        return $this->label;
    }

    public function getValue(): string {
        return $this->value;
    }

    public function setId(int $id) {
        $this->id = $id;
        return $this;
    }

    public function setLabel(string $label) {
        $this->label = $label;
        return $this;
    }

    public function setValue(string $value) {
        $this->value = $value;
        return $this;
    }
}
