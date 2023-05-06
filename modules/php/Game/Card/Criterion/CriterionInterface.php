<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SmileLife\Card\Criterion\CardCriterion;

/**
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
interface CriterionInterface {
    public function isFulfilled(...$args): bool;
    public function isNotFulfilled(...$args): bool;
}
