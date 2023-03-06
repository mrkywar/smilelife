<?php
namespace SmileLife\Game\GameTrait;
/**
 * Description of ZombieTrait
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
trait ZombieTrait {
    /*
      zombieTurn:

      This method is called each time it is the turn of a player who has quit the game (= "zombie" player).
      You can do whatever you want in order to make sure the turn of this player ends appropriately
      (ex: pass).

      Important: your zombie code will be called when the player leaves the game. This action is triggered
      from the main site and propagated to the gameserver from a server, not from a browser.
      As a consequence, there is no current player associated to this action. In your zombieTurn function,
      you must _never_ use getCurrentPlayerId() or getCurrentPlayerName(), otherwise it will fail with a "Not logged" error message.
     */

    public function zombieTurn($state, $active_player) {
        $statename = $state['name'];

        if ($state['type'] === "activeplayer") {
            switch ($statename) {
                default:
                    $this->gamestate->nextState("zombiePass");
                    break;
            }

            return;
        }

        if ($state['type'] === "multipleactiveplayer") {
            // Make sure player is in a non blocking status for role turn
            $this->gamestate->setPlayerNonMultiactive($active_player, '');

            return;
        }

        throw new feException("Zombie mode not supported at this game state: " . $statename);
    }

}
