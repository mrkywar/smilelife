<?php

namespace SmileLife\Card\Effect;

/**
 * Description of PassTurnInterface
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
interface PassTurnInterface {

    public function getId():int;

    public function getTurnsToPass(): int;
}
