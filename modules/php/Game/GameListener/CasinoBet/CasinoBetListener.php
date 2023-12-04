<?php

namespace SmileLife\Game\GameListener\CasinoBet;

use Core\Event\EventListener\EventListener;
use Core\Requester\Response\Response;
use SmileLife\Card\Card;
use SmileLife\Card\CardManager;
use SmileLife\Card\Category\Wage\Wage;
use SmileLife\Card\Criterion\CriterionTester\CriterionTester;
use SmileLife\Card\Criterion\GenericCriterion\CardTypeCriterion;
use SmileLife\Card\Criterion\GenericCriterion\CriterionGroup;
use SmileLife\Card\Criterion\SpecialCriterion\CasinoOpenedCriterion;
use SmileLife\Card\Criterion\SpecialCriterion\CasinoWagePlayedCriterion;
use SmileLife\Game\Request\CasinoBetRequest;
use SmileLife\PlayerAction\ActionType;
use SmileLife\Table\PlayerTable;
use SmileLife\Table\PlayerTableManager;

/**
 * Description of DiscardListener
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class CasinoBetListener extends EventListener {

    /**
     * 
     * @var CardManager
     */
    private $cardManager;

    /**
     * 
     * @var PlayerTableManager
     */
    private $tableManager;

    public function __construct() {
        $this->setMethod("onCasinoBet");

        $this->cardManager = new CardManager();
        $this->tableManager = new PlayerTableManager();
    }

    public function onCasinoBet(CasinoBetRequest &$request, Response &$response) {
        $card = $request->getCard();
        $player = $request->getPlayer();
        $table = $this->tableManager->findBy(["id" => $player->getId()]);

        $criterion = $this->getCasinoSpecialActionCriterion($card, $table);
        
        
        $criteriaTester = new CriterionTester();
        $testRestult = $criteriaTester->test($criterion);

        if (!$testRestult->isValided()) {
            throw new \BgaUserException($testRestult->getErrorMessage());
        }

        $response->set("from", $card->getLocation());

        $response->set('player', $player)
                ->set('card', $card)
                ->set("table", $table)
                ->set('consequences', null)
                ->set('consequences', $criterion->getConsequences());
       
    }

    private function getCasinoSpecialActionCriterion(Card $card, PlayerTable $table) {
        $wageCriterion = new CardTypeCriterion($card, Wage::class);
        $casinoOpened = new CasinoOpenedCriterion($table);
        $wagesAllreadyBet = new CasinoWagePlayedCriterion();
        $wageCriterion->setErrorMessage(clienttranslate("You must choose a salary"));

        $casinoCriterion = new CriterionGroup([
            $casinoOpened,
            $wagesAllreadyBet
                ], CriterionGroup::OR_OPERATOR);
        $casinoCriterion->setErrorMessage(clienttranslate("Casino isn't oppened"));


        return new CriterionGroup([
            $wageCriterion,
            $casinoCriterion
                ], CriterionGroup::AND_OPERATOR);
    }

    public function eventName(): string {
        return ActionType::ACTION_SPECIAL_CASINO;
    }

    public function getPriority(): int {
        return 1;
    }
}
