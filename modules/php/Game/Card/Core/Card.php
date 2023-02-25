<?php

namespace SmileLife\Game\Card\Core;

use Core\Models\Core\Model;
use Core\Models\Player;
use SmileLife;

/**
 * Description of Card
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 * @ORM\Table{"name":"card"}
 */
abstract class Card extends Model {

    /**
     * 
     * @var int|null
     * @ORM\Column{"type":"integer", "name":"card_id" ,"exclude":["insert"]}
     * @ORM\Id
     */
    private $id;

    /**
     * 
     * @var string
     * @ORM\Column{"type":"string", "name":"card_class"}
     */
    private $class;

    /**
     * 
     * @var int|null
     * @ORM\Column{"type":"integer", "name":"card_type"}
     */
    private $type;

    /**
     * 
     * @var int|null
     * @ORM\Column{"type":"integer", "name":"card_owner_id"}
     */
    private $ownerId;

    /**
     * 
     * @var string|null
     * @ORM\Column{"type":"string", "name":"card_location", "default":"deck"}
     */
    private $location;

    /**
     * 
     * @var int|null
     * @ORM\Column{"type":"integer", "name":"card_location_arg"}
     */
    private $locationArg = 0;

    /**
     * 
     * @var int|null
     * @ORM\Column{"type":"integer", "name":"card_discarder_id"}
     */
    private $discarderId;

    /**
     * 
     * @var bool
     * @ORM\Column{"type":"bool", "name":"card_is_flipped", "default":"false"}
     */
    private $isFlipped;

    /**
     * 
     * @var bool
     * @ORM\Column{"type":"bool", "name":"card_is_rotated", "default":"false"}
     */
    private $isRotated;

    /* -------------------------------------------------------------------------
     *                  BEGIN - Unpersisted property
     * ---------------------------------------------------------------------- */

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $subtitle;

    /**
     * @var string
     */
    protected $text1;

    /**
     * @var string
     */
    protected $text2;

    /* -------------------------------------------------------------------------
     *                  BEGIN - Constructor & Display
     * ---------------------------------------------------------------------- */

    public function __construct() {
        $this->setLocation(CardLocation::DECK)
                ->setIsFlipped(false)
                ->setIsRotated(false)
                ->setTitle("")
                ->setSubtitle("")
                ->setText1("")
                ->setText2("");
    }

    public function __toString() {
        $str = get_class($this);
        $str .= '<br />';
        $str .= $this->getSmilePoints() . ($this->getSmilePoints() <= 1 ? ' smile' : ' smiles');
        if (count($this->getTexts()) > 0) {
            $str .= '<br /><br />';
            foreach ($this->getTexts() as $text) {
                $str .= $text['str'] . '<br />';
            }
        }
        if (count($this->getHelps()) > 0) {
            $str .= '<br /><br />';
            $str .= implode('<br />', $this->getHelps());
        }
        return $str;
    }

    public function getVisibleClasses() {
        $searcheString = "Card\\Category";
        $classname = substr(
                $this->getClass(),
                strpos($this->getClass(), $searcheString) + strlen($searcheString) + 1
        );
        $classes = array_unique(explode("\\", strtolower($classname)));

        return "card_".implode(" card_", $classes);
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    abstract public function canBePlayed(): bool;

    abstract public function canBeAttacked(): bool;

    abstract public function getSmilePoints(): int;

    abstract public function getType(): int;

    abstract public function getClass(): string;

    /* -------------------------------------------------------------------------
     *                  BEGIN - Getters & Setters 
     * ---------------------------------------------------------------------- */

    public function getId(): ?int {
        return $this->id;
    }

    public function getOwnerId(): ?int {
        return $this->ownerId;
    }

    public function getLocation(): ?string {
        return $this->location;
    }

    public function getLocationArg(): ?int {
        return $this->locationArg;
    }

    public function getDiscarderId(): ?int {
        return $this->discarderId;
    }

    public function getIsFlipped(): bool {
        return $this->isFlipped;
    }

    public function getIsRotated(): bool {
        return $this->isRotated;
    }

    public function setId(?int $id) {
        $this->id = $id;
        return $this;
    }

    public function setClass(string $class) {
        $this->class = $class;
        return $this;
    }

    public function setOwnerId(?int $ownerId) {
        $this->ownerId = $ownerId;
        return $this;
    }

    public function setLocation(string $location) {
        $this->location = $location;
        return $this;
    }

    public function setLocationArg(?int $locationArg) {
        $this->locationArg = $locationArg;
        return $this;
    }

    public function setDiscarderId(?int $discarderId) {
        $this->discarderId = $discarderId;
        return $this;
    }

    public function setIsFlipped(bool $isFlipped) {
        $this->isFlipped = $isFlipped;
        return $this;
    }

    public function setIsRotated(bool $isRotated) {
        $this->isRotated = $isRotated;
        return $this;
    }

    public function getTexts(): array {
        return $this->texts;
    }

    public function getHelps(): array {
        return $this->helps;
    }

    public function setType(?int $type) {
        $this->type = $type;
        return $this;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function getSubtitle(): string {
        return $this->subtitle;
    }

    public function getText1(): string {
        return $this->text1;
    }

    public function getText2(): string {
        return $this->text2;
    }

    public function setTitle(string $title) {
        $this->title = $title;
        return $this;
    }

    public function setSubtitle(string $subtitle) {
        $this->subtitle = $subtitle;
        return $this;
    }

    public function setText1(string $text1) {
        $this->text1 = $text1;
        return $this;
    }

    public function setText2(string $text2) {
        $this->text2 = $text2;
        return $this;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Array Add Item
     * ---------------------------------------------------------------------- */

    public function addText(string $text) {
        $this->texts[] = $text;
        return $this;
    }

    public function addHelp(string $help) {
        $this->helps[] = $help;
        return $this;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Shortcut
     * ---------------------------------------------------------------------- */

    public function getPlayerOwner(): ?Player {
        if (null !== $this->getOwnerId()) {
            return SmileLife::getInstance()
                            ->getPlayerManager()
                            ->findBy(["id" => $this->getOwnerId()]);
        }
        return null;
    }

    public function setPlayerOwner(Player $player) {
        return $this->setOwnerId($player->getId());
    }

    public function getPlayerDiscarder(): ?Player {
        if (null !== $this->getDiscarderId()) {
            return SmileLife::getInstance()
                            ->getPlayerManager()
                            ->findBy(["id" => $this->getDiscarderId()]);
        }
        return null;
    }

    public function setPlayerDiscarder(Player $player) {
        return $this->setDiscarderId($player->getId());
    }

}
