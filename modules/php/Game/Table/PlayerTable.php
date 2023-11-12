<?php

namespace SmileLife\Table;

use Core\Managers\PlayerManager;
use Core\Models\Core\Model;
use Core\Models\Player;
use SmileLife\Card\Card;
use SmileLife\Card\CardManager;
use SmileLife\Card\Category\Acquisition\Acquisition;
use SmileLife\Card\Category\Attack\Attack;
use SmileLife\Card\Category\Child\Child;
use SmileLife\Card\Category\Job\Job;
use SmileLife\Card\Category\Love\Adultery;
use SmileLife\Card\Category\Love\Flirt\Flirt;
use SmileLife\Card\Category\Love\Marriage\Marriage;
use SmileLife\Card\Category\Pet\Pet;
use SmileLife\Card\Category\Reward\Reward;
use SmileLife\Card\Category\Special\JobBoost;
use SmileLife\Card\Category\Special\Rainbow;
use SmileLife\Card\Category\Special\Special;
use SmileLife\Card\Category\Studies\Studies;
use SmileLife\Card\Category\Wage\Wage;

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
     * @ORM\Column{"type":"int", "name":"table_job", "default":null}
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
     * @ORM\Column{"type":"int", "name":"table_marriage", "default":null}
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
     * @ORM\Column{"type":"int", "name":"table_adultery", "default":null}
     */
    private $adulteryId;

    /**
     * 
     * @var array
     * @ORM\Column{"type":"json", "name":"table_adultery_flirts"}
     */
    private $adulteryFlirtIds;

    /**
     * 
     * @var array
     * @ORM\Column{"type":"json", "name":"table_specials"}
     */
    private $specialsIds;

    /**
     * 
     * @var CardManager
     */
    private $cardManager;

    /**
     * 
     * @var PlayerManager
     */
    private $playerManager;

    /**
     * 
     * @var Player
     */
    private $player;

    /* -------------------------------------------------------------------------
     *                  BEGIN - Constructor
     * ---------------------------------------------------------------------- */

    public function __construct() {
        $this->cardManager = new CardManager();
        $this->playerManager = new PlayerManager();

        $this->wageIds = [];
        $this->studiesIds = [];
        $this->acquisitionIds = [];
        $this->attackIds = [];
        $this->childIds = [];
        $this->flirtIds = [];
        $this->adulteryFlirtIds = [];
        $this->rewardIds = [];
        $this->specialsIds = [];

//        $this->adulteryId = null;
//        $this->jobId = null;
//        $this->marriageId = null;
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Sorting Pile
     * ---------------------------------------------------------------------- */

    protected function sortPile(&$cards, $orderedId) {
        // Fonction de comparaison pour le tri
        $compareFunction = function ($a, $b) use ($orderedId) {
            $indexA = array_search($a->getId(), $orderedId);
            $indexB = array_search($b->getId(), $orderedId);
            return $indexA - $indexB;
        };

        // Tri du tableau selon l'ordre des IDs
        usort($cards, $compareFunction);
    }

    /* -------------------------------------------------------------------------
     *                  BEGIN - Shortcut
     * ---------------------------------------------------------------------- */

    public function addCard(Card $card) {
        if ($card instanceof Studies) {
            return $this->addStudy($card);
        } elseif ($card instanceof Wage) {
            return $this->addWage($card);
        } elseif ($card instanceof Job) {
            return $this->setJob($card);
        } elseif ($card instanceof Marriage) {
            return $this->setMarriage($card);
        } elseif ($card instanceof Adultery) {
            return $this->setAdultery($card);
        } elseif ($card instanceof Child) {
            return $this->addChild($card);
        } elseif ($card instanceof Flirt) {
            return $this->addFlirt($card);
        } elseif ($card instanceof Reward) {
            return $this->addReward($card);
        } elseif ($card instanceof Acquisition) {
            return $this->addAcquisition($card);
        } elseif ($card instanceof Attack) {
            return $this->addAttack($card);
        } elseif ($card instanceof Special) {
            return $this->addSpecial($card);
        } elseif ($card instanceof Pet) {
            return $this->addPet($card);
        } else {
            throw new PlayerTableException("PTE - 01 - Unsupported Card" . get_class($card));
        }
    }

    public function removeCard(Card $card) {
        if ($card instanceof Studies) {
            return $this->removeStudy($card);
        } elseif ($card instanceof Flirt) {
            return $this->removeFlirt($card);
        } elseif ($card instanceof Wage) {
            return $this->removeWage($card);
        } elseif ($card instanceof Job) {
            $this->jobId = null;
            return $this;
        } elseif ($card instanceof Marriage) {
            $this->marriageId = null;
            return $this;
        } elseif ($card instanceof Adultery) {
            $this->adulteryId = null;
            return $this;
        } elseif ($card instanceof Child) {
            return $this->removeChild($card);
        } elseif ($card instanceof Attack) {
            return $this->removeAttack($card);
        } else {
            throw new PlayerTableException("PTE - 01 - Unsupported Card" . get_class($card));
        }
    }

    public function setPlayer(Player $player) {
        $this->player = $player;
        return $this->setId($player->getId());
    }

    public function getPlayer(): Player {
        if (null === $this->player) {
            $this->player = $this->playerManager
                    ->findBy(["id" => $this->getId()]);
        }
        return $this->player;
    }

    public function setJob(Job $card) {
        $this->setJobId($card->getId());

        return $this;
    }

    public function getJob(): ?Job {
        if (null === $this->getJobId()) {
            return null;
        }
        return $this->cardManager
                        ->findBy(["id" => $this->getJobId()]);
    }

    public function setMarriage(Marriage $card) {
        $this->setMarriageId($card->getId());

        return $this;
    }

    public function getMarriage(): ?Marriage {
        if (null === $this->getMarriageId()) {
            return null;
        }
        return $this->cardManager
                        ->findBy(["id" => $this->getMarriageId()]);
    }

    public function setAdultery(Adultery $card) {
        $this->setAdulteryId($card->getId());

        return $this;
    }

    public function getAdultery(): ?Adultery {
        if (null === $this->getAdulteryId()) {
            return null;
        }
        return $this->cardManager
                        ->findBy(["id" => $this->getAdulteryId()]);
    }

    public function addWage(Wage $card) {
        $this->wageIds[] = $card->getId();
        return $this;
    }

    public function removeWage(Wage $card) {
        $searchedId = $card->getId();
        $this->wageIds = array_values(
                array_filter($this->wageIds, function ($wageId) use ($searchedId) {
                    return $searchedId !== $wageId;
                })
        );

        return $this;
    }

    public function getWages() {
        if (empty($this->getWageIds())) {
            return [];
        }

        $this->cardManager->getSerializer()
                ->setIsForcedArray(true);
        $cards = $this->cardManager
                ->findBy(["id" => $this->getWageIds()]);

        $this->sortPile($cards, $this->getWageIds());

        $this->cardManager->getSerializer()
                ->setIsForcedArray(false);

        return $cards;
    }

    public function getLastWage(): ?Wage {
        $wages = $this->getWages();
        if (empty($wages)) {
            return null;
        } else {
            return $wages[sizeof($wages) - 1];
        }
    }

    public function addChild(Child $card) {
        $this->childIds[] = $card->getId();

        return $this;
    }

    public function removeChild(Child $card) {
        $searchedId = $card->getId();
        $this->childIds = array_values(
                array_filter($this->childIds, function ($childIds) use ($searchedId) {
                    return $searchedId !== $childIds;
                })
        );

        return $this;
    }

    public function getChilds() {
        if (empty($this->getChildIds())) {
            return [];
        }

        $this->cardManager->getSerializer()
                ->setIsForcedArray(true);
        $cards = $this->cardManager
                ->findBy(["id" => $this->getChildIds()]);

        $this->sortPile($cards, $this->getChildIds());

        $this->cardManager->getSerializer()
                ->setIsForcedArray(false);

        return $cards;
    }

    public function addStudy(Studies $card) {
        $this->studiesIds[] = $card->getId();

        return $this;
    }

    public function removeStudy(Studies $card) {
        $searchedId = $card->getId();
        $this->studiesIds = array_values(
                array_filter($this->studiesIds, function ($studyId) use ($searchedId) {
                    return $searchedId !== $studyId;
                })
        );

        return $this;
    }

    public function getStudies() {
        if (empty($this->getStudiesIds())) {
            return [];
        }

        $this->cardManager->getSerializer()
                ->setIsForcedArray(true);
        $cards = $this->cardManager
                ->findBy(["id" => $this->getStudiesIds()]);

        $this->sortPile($cards, $this->getStudiesIds());

        $this->cardManager->getSerializer()
                ->setIsForcedArray(false);

        return $cards;
    }

    public function getLastStudies(): ?Studies {
        $studies = $this->getStudies();
        if (empty($studies)) {
            return null;
        } else {
            return $studies[sizeof($studies) - 1];
        }
    }

    public function addFlirt(Flirt $card) {
        if (null === $this->getAdultery()) {
            $this->flirtIds[] = $card->getId();
        } else {
            $this->adulteryFlirtIds[] = $card->getId();
        }

        return $this;
    }

    public function removeFlirt(Flirt $card) {
        $searchedId = $card->getId();
        if (null === $this->getAdultery()) {
            $this->flirtIds = array_values(
                    array_filter($this->flirtIds, function ($flirtId) use ($searchedId) {
                        return $searchedId !== $flirtId;
                    })
            );
        } else {
            $this->adulteryFlirtIds = array_values(
                    array_filter($this->adulteryFlirtIds, function ($flirtId) use ($searchedId) {
                        return $searchedId !== $flirtId;
                    })
            );
        }

        return $this;
    }

    public function getFlirts() {
        if (empty($this->getFlirtIds())) {
            return [];
        }

        $this->cardManager->getSerializer()
                ->setIsForcedArray(true);
        $cards = $this->cardManager
                ->findBy(["id" => $this->getFlirtIds()]);

        $this->sortPile($cards, $this->getFlirtIds());

        $this->cardManager->getSerializer()
                ->setIsForcedArray(false);

        return $cards;
    }

    public function getAdulteryFlirts() {
        if (empty($this->getAdulteryFlirtIds())) {
            return [];
        }

        $this->cardManager->getSerializer()
                ->setIsForcedArray(true);
        $cards = $this->cardManager
                ->findBy(["id" => $this->getAdulteryFlirtIds()]);

        $this->sortPile($cards, $this->getAdulteryFlirtIds());

        $this->cardManager->getSerializer()
                ->setIsForcedArray(false);

        return $cards;
    }

    public function getLastFlirt(): ?Flirt {
        $flirts = $this->getFlirts();
        if (empty($flirts)) {
            return null;
        } else {
            return $flirts[sizeof($flirts) - 1];
        }
    }

    public function getLastAdulteryFlirt(): ?Flirt {
        $flirts = $this->getAdulteryFlirts();
        if (empty($flirts)) {
            return null;
        } else {
            return $flirts[sizeof($flirts) - 1];
        }
    }
    
    public function getRainbow():?Rainbow {
        foreach ($this->getSpecials() as $card){
           if($card instanceof Rainbow){
               return $card;
           }
        }
        return null;
    }

    public function addReward(Reward $card) {
        $this->rewardIds[] = $card->getId();

        return $this;
    }

    public function getRewards() {
        if (empty($this->getRewardIds())) {
            return [];
        }

        $this->cardManager->getSerializer()
                ->setIsForcedArray(true);
        $cards = $this->cardManager
                ->findBy(["id" => $this->getRewardIds()]);

        $this->sortPile($cards, $this->getRewardIds());

        $this->cardManager->getSerializer()
                ->setIsForcedArray(false);

        return $cards;
    }

    public function addAcquisition(Acquisition $card) {
        $this->acquisitionIds[] = $card->getId();

        return $this;
    }

    public function getAcquisitions() {
        if (empty($this->getAcquisitionIds())) {
            return [];
        }

        $this->cardManager->getSerializer()
                ->setIsForcedArray(true);
        $cards = $this->cardManager
                ->findBy(["id" => $this->getAcquisitionIds()]);

        $this->sortPile($cards, $this->getAcquisitionIds());

        $this->cardManager->getSerializer()
                ->setIsForcedArray(false);

        return $cards;
    }

    public function addAttack(Attack $card) {
        $this->attackIds[] = $card->getId();

        return $this;
    }

    public function removeAttack(Attack $card) {
        $searchedId = $card->getId();
        $this->attackIds = array_values(
                array_filter($this->attackIds, function ($attackId) use ($searchedId) {
                    return $searchedId !== $attackId;
                })
        );

        return $this;
    }

    public function getAttacks() {
        if (empty($this->getAttackIds())) {
            return [];
        }

        $this->cardManager->getSerializer()
                ->setIsForcedArray(true);
        $cards = $this->cardManager
                ->findBy(["id" => $this->getAttackIds()]);

        $this->sortPile($cards, $this->getAttackIds());

        $this->cardManager->getSerializer()
                ->setIsForcedArray(false);

        return $cards;
    }

    public function addPet(Pet $card) {
        $this->acquisitionIds[] = $card->getId();

        return $this;
    }

    public function addSpecial(Special $card) {
        $this->specialsIds[] = $card->getId();

        return $this;
    }

    public function getSpecials() {
        if (empty($this->getSpecialsIds())) {
            return [];
        }

        $this->cardManager->getSerializer()
                ->setIsForcedArray(true);
        $cards = $this->cardManager
                ->findBy(["id" => $this->getSpecialsIds()]);

        $this->sortPile($cards, $this->getSpecialsIds());

        $this->cardManager->getSerializer()
                ->setIsForcedArray(false);

        return $cards;
    }

    public function getJobBoost(): ?JobBoost {
        foreach ($this->getSpecials() as $card) {
            if ($card instanceof JobBoost) {
                return $card;
            }
        }
        return null;
    }

    protected function getCardsId() {
        $ids = array_merge(
                $this->acquisitionIds,
                $this->attackIds,
                $this->childIds,
                $this->flirtIds,
                $this->adulteryFlirtIds,
                $this->rewardIds,
                $this->specialsIds,
                $this->studiesIds,
                $this->wageIds,
                [
                    $this->adulteryId,
                    $this->jobId,
                    $this->marriageId,
                ]
        );

        return array_filter($ids, function ($value) {
            return null !== $value;
        });
    }

    public function getCards() {
        $ids = $this->getCardsId();
        if (!empty($ids)) {
            $this->cardManager->getSerializer()->setIsForcedArray(true);
            $cards = $this->cardManager->findBy([
                "id" => $ids
            ]);
            $this->cardManager->getSerializer()->setIsForcedArray(false);
            return $cards;
        } else {
            return [];
        }
    }

    public function resignAdultery() {
        $this->flirtIds = array_merge($this->flirtIds, $this->adulteryFlirtIds);
        $this->adulteryFlirtIds = [];
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

    public function getAdulteryFlirtIds(): array {
        return $this->adulteryFlirtIds;
    }

    public function getPetIds(): array {
        return $this->petIds;
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

    public function setAdulteryFlirtIds(array $adulteryFlirtIds) {
        $this->adulteryFlirtIds = $adulteryFlirtIds;
        return $this;
    }

    public function setPetIds(array $petIds) {
        $this->petIds = $petIds;
        return $this;
    }

    public function getSpecialsIds(): array {
        return $this->specialsIds;
    }

    public function setSpecialsIds(array $specialsIds) {
        $this->specialsIds = $specialsIds;
        return $this;
    }

}
