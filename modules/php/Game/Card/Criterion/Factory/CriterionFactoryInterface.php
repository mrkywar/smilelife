<?php
namespace SmileLife\Card\Criterion\Factory;

/**
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
interface CriterionFactoryInterface {

    /**
     * 
     * @return ?CriterionInterface[]
     */
    public function create(): ?array;
}
