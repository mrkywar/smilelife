<?php

namespace SmileLife\Card\Criterion;

use SmileLife\Card\Criterion\CardCriterion\CriterionInterface;

/**
 * Description of Criterion
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
abstract class Criterion implements CriterionInterface {
    abstract public function isValided(): bool;

}
