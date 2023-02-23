<?php

namespace SmileLife\Game\Table;

use Core\Models\Core\Model;
use Core\Models\Player;
use SmileLife;
use SmileLife\Game\Card\Category\Acquisition\Acquisition;
use SmileLife\Game\Card\Category\Attack\Attack;
use SmileLife\Game\Card\Category\Child\Child;
use SmileLife\Game\Card\Category\Job\Job;
use SmileLife\Game\Card\Category\Job\Reward\Reward;
use SmileLife\Game\Card\Category\Love\Adultery;
use SmileLife\Game\Card\Category\Love\Flirt\Flirt;
use SmileLife\Game\Card\Category\Love\Wedding\Wedding;
use SmileLife\Game\Card\Category\Studies\Studies;
use SmileLife\Game\Card\Category\Wage\Wage;
use SmileLife\Game\Card\Core\CardManager;

/**
 * Description of Game
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */

/**
 * Description of PlayerTable
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 * @ORM\Table{"name":"player_table"}
 */
class PlayerTable extends Model {

    /**
     * 
     * @var int
     * @ORM\Column{"type":"integer", "name":"table_player_id"}
     * @ORM\Id
     */
    private $id;

    /**
     * 
     * @var array
     * @ORM\Column{"type":"json", "name":"table_warges"}
     */
    private $wageIds;

    /**
     * 
     * @var array
     * @ORM\Column{"type":"json", "name":"table_childs"}
     */
    private $childIds;

    /**
     * 
     * @var array
     * @ORM\Column{"type":"json", "name":"table_sudies"}
     */
    private $studiesIds;

    /**
     * 
     * @var int|null
     * @ORM\Column{"type":"int", "name":"table_job"}
     */
    private $jobId;

    /**
     * 
     * @var array
     * @ORM\Column{"type":"json", "name":"table_rewards"}
     */
    private $rewardIds;

    /**
     * 
     * @var int|null
     * @ORM\Column{"type":"int", "name":"table_marriage"}
     */
    private $marriageId;

    /**
     * 
     * @var array
     * @ORM\Column{"type":"json", "name":"table_flirts"}
     */
    private $flirtIds;

    /**
     * 
     * @var array
     * @ORM\Column{"type":"json", "name":"table_acquisitions"}
     */
    private $acquisitionIds;

    /**
     * 
     * @var array
     * @ORM\Column{"type":"json", "name":"table_attacks"}
     */
    private $attackIds;

    /**
     * 
     * @var int|null
     * @ORM\Column{"type":"int", "name":"table_adultery"}
     */
    private $adulteryId;

    /**
     * 
     * @var CardManager
     */
    private $cardManager;

    /* -------------------------------------------------------------------------
     *                  BEGIN - Constructor
     * ---------------------------------------------------------------------- */

    public function __construct() {
        $this->cardManager = new CardManager();

        $this->wageIds = [];
        $this->studiesIds = [];
        $this->acquisitionIds = [];
        $this->attackIds = [];
        $this->childIds = [];
        $this->flirtIds = [];
        $this->rewardIds = [];
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

    public function setJob(Job $card) {
        $this->setJobId($card->getId());

        return $this;
    }

    public function getJob($param): ?Job {
        return $this->cardManager
                        ->findBy(["id" => $this->getJobId()]);
    }

    public function setMarriage(Wedding $card) {
        $this->setMarriageId($card->getId());

        return $this;
    }

    public function getMarriage(): ?Wedding {
        return $this->cardManager
                        ->findBy(["id" => $this->getJobId()]);
    }

    public function setAdultery(Adultery $card) {
        $this->setAdulteryId($card->getId());

        return $this;
    }

    public function getAdultery(): ?Adultery {
        return $this->cardManager
                        ->findBy(["id" => $this->getJobId()]);
    }

    public function addWage(Wage $card) {
        $this->wageIds[] = $card->getId();
        var_dump($card);die;

        return $this;
    }

    public function getWages() {
        if (empty($this->getWageIds())) {
            return [];
        }
        return $this->cardManager
                        ->findBy(["id" => $this->getWageIds()]);
    }

    public function addChild(Child $card) {
        $this->childIds[] = $card->getId();

        return $this;
    }

    public function getChilds() {
        return $this->cardManager
                        ->findBy(["id" => $this->getChildIds()]);
    }

    public function addStudy(Studies $card) {
        $this->studiesIds[] = $card->getId();

        return $this;
    }

    public function getStudies() {
        return $this->cardManager
                        ->findBy(["id" => $this->getStudiesIds()]);
    }

    public function addFlirt(Flirt $card) {
        $this->flirtIds[] = $card->getId();

        return $this;
    }

    public function getFlirts() {
        return $this->cardManager
                        ->findBy(["id" => $this->getFlirtIds()]);
    }

    public function addReward(Reward $card) {
        $this->rewardIds[] = $card->getId();

        return $this;
    }

    public function getRewards() {
        return $this->cardManager
                        ->findBy(["id" => $this->getRewardIds()]);
    }

    public function addAcquision(Acquisition $card) {
        $this->acquisitionIds[] = $card->getId();

        return $this;
    }

    public function getAcquisions() {
        return $this->cardManager
                        ->findBy(["id" => $this->getAcquisitionIds()]);
    }

    public function addAttack(Attack $card) {
        $this->attackIds[] = $card->getId();

        return $this;
    }

    public function getAttacks() {
        return $this->cardManager
                        ->findBy(["id" => $this->getAttackIds()]);
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Getters & Setters 
     * ---------------------------------------------------------------------- */

    public function getId(): int {
        return $this->id;
    }

    public function getWageIds(): array {
        return $this->wageIds;
    }

    public function getChildIds(): array {
        return $this->childIds;
    }

    public function getStudiesIds(): array {
        return $this->studiesIds;
    }

    public function getJobId(): ?int {
        return $this->jobId;
    }

    public function getRewardIds(): array {
        return $this->rewardIds;
    }

    public function getMarriageId(): ?int {
        return $this->marriageId;
    }

    public function getFlirtIds(): array {
        return $this->flirtIds;
    }

    public function getAcquisitionIds(): array {
        return $this->acquisitionIds;
    }

    public function getAttackIds(): array {
        return $this->attackIds;
    }

    public function getAdulteryId(): ?int {
        return $this->adulteryId;
    }

    public function setId(int $id) {
        $this->id = $id;
        return $this;
    }

    public function setWageIds(array $wageIds) {
        $this->wageIds = $wageIds;
        return $this;
    }

    public function setChildIds(array $childIds) {
        $this->childIds = $childIds;
        return $this;
    }

    public function setStudiesIds(array $studiesIds) {
        $this->studiesIds = $studiesIds;
        return $this;
    }

    public function setJobId(?int $jobId) {
        $this->jobId = $jobId;
        return $this;
    }

    public function setRewardIds(array $rewardIds) {
        $this->rewardIds = $rewardIds;
        return $this;
    }

    public function setMarriageId(?int $marriageId) {
        $this->marriageId = $marriageId;
        return $this;
    }

    public function setFlirtIds(array $flirtIds) {
        $this->flirtIds = $flirtIds;
        return $this;
    }

    public function setAcquisitionIds(array $acquisitionIds) {
        $this->acquisitionIds = $acquisitionIds;
        return $this;
    }

    public function setAttackIds(array $attackIds) {
        $this->attackIds = $attackIds;
        return $this;
    }

    public function setAdulteryId(?int $adulteryId) {
        $this->adulteryId = $adulteryId;
        return $this;
    }

}
