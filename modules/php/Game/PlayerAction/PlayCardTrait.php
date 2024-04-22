<?php

namespace SmileLife\PlayerAction;

use Core\DB\QueryString;
use SmileLife\Card\Card;
use SmileLife\Card\CardManager;
use SmileLife\Card\Core\Exception\CardException;
use SmileLife\Game\Request\PlayCardRequest;

/**
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
trait PlayCardTrait {

    protected function doPlayCard(Card $card, $targetId = null, $additionalIds = null) {
        $player = $this->getActualPlayer();
        $target = $targetId;
        $cardsId = null;
        if (null !== $additionalIds && "" !== $additionalIds) {
            $cardsId = explode(",", $additionalIds);
        }

        if (null !== $targetId) {
            $target = $this->playerManager->findOne([
                "id" => $targetId
            ]);
        }
        // before [sc-137] was $additionalCards = $additionalIds;
        $additionalCards = $cardsId;
        if (null !== $additionalIds && !empty($cardsId)) {
            $cm = new CardManager();

            $this->cardManager->getSerializer()->setIsForcedArray(true);
            $additionalCards = $this->cardManager->findBy([
                "id" => $cardsId
                    ], null, [
                "id" => array(QueryString::QUERY_FUNCTION => 'FIELD ( ' . QueryString::SUBSTITUTION_DBNAME . ',' . $additionalIds . ' )')
                    ]
            );
            $this->cardManager->getSerializer()->setIsForcedArray(false);
        }

        try {
            $request = new PlayCardRequest($player, $card, $target, $additionalCards);
            $response = $this->requester->send($request);

            $this->applyResponse($response);
        } catch (CardException $e) {
            throw new \BgaVisibleSystemException($e->getMessage());
        }
    }

    public function actionPlayCard($cardId, $targetId = null, $additionalIds = null) {
        self::checkAction('playCard');

        $card = $this->cardManager->findBy([
            "id" => $cardId
        ]);

        $this->doPlayCard($card, $targetId, $additionalIds);
    }
}
