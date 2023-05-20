<?php
namespace SmileLife\Card\Criterion;

/**
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
interface CriterionInterface {
    public function isValided(): bool;
    
    /**
     * @return string
     */
    public function getErrorMessage();
}
