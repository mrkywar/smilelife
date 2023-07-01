<?php

namespace SmileLife\Card;

use Core\Models\Core\Model;
use Core\Models\Player;
use SmileLife;
use SmileLife\Card\Core\CardLocation;
use SmileLife\Card\Criterion\Factory\CardCriterionFactory;

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
     * @var string|null
     * @ORM\Column{"type":"string", "name":"card_table_location"}
     */
    private $tableLocation = 0;

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
     * @ORM\Column{"type":"bool", "name":"card_is_used", "default":"false"}
     */
    private $isUsed;

    /**
     * 
     * @var int
     * @ORM\Column{"type":"int", "name":"card_pass_turn"}
     */
    private $passTurn;

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
                ->setIsUsed(false)
                ->setTitle("")
                ->setSubtitle("")
                ->setText1("")
                ->setText2("")
                ->setPassTurn($this->getDefaultPassTurn());
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

    public function getName() {
        $searcheString = "Card\\Category";
        $classname = substr(
                $this->getClass(),
                strpos($this->getClass(), $searcheString) + strlen($searcheString) + 1
        );
        $classes = array_unique(explode("\\", strtolower($classname)));

        return end($classes);
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    abstract public function getSmilePoints(): int;

    abstract public function getType(): int;

    abstract public function getClass(): string;

    abstract public function getCategory(): string;

    abstract public function getPileName(): string;

    abstract protected function getDefaultPassTurn(): int;

    abstract public function getCriterionFactory(): CardCriterionFactory;

//    abstract public function getDisplayedName():string;

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

    public function getIsUsed(): bool {
        return $this->isUsed;
    }

    public function getTableLocation(): ?string {
        return $this->tableLocation;
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

    public function setIsUsed(bool $isUsed) {
        $this->isUsed = $isUsed;
        return $this;
    }

    public function setTableLocation(?string $tableLocation) {
        $this->tableLocation = $tableLocation;
        return $this;
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

    public function getPassTurn(): int {
        return $this->passTurn;
    }

    public function setPassTurn(int $passTurn) {
        $this->passTurn = $passTurn;
        return $this;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Array transform (Display)
     * ---------------------------------------------------------------------- */

    public function __toArray(): array {
        return [
            "id" => $this->getId(),
            "type" => $this->getType(),
            "category" => $this->getCategory(),
            "pile" => $this->getPileName(),
            "name" => $this->getName(),
            "smilePoints" => $this->getSmilePoints(),
            "location" => $this->getLocation(),
            "title" => $this->getTitle(),
            "subtitle" => $this->getSubTitle(),
            "text1" => $this->getText1(),
            "text2" => $this->getText2(),
            "isFlipped" => $this->getIsFlipped(),
            "isUsed" => $this->getIsUsed()
        ];
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
