<?php
namespace SmileLife\Card\Criterion;

use SmileLife\Card\Consequence\Consequence;

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
    
    public function hasConsequences(): bool;
    
    /**
     * 
     * @return ?Consequence[]
     */
    public function getConsequences(): ?array;
    
    public function addConsequence(Consequence $consequence):CriterionInterface;
    
    
}
