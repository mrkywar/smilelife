<?php
namespace SmileLife\Card\Criterion\SpecialCriterion;

use SmileLife\Card\CardManager;
use SmileLife\Card\Criterion\PlayerTableCriterion\PlayerTableCriterion;
use SmileLife\Table\PlayerTable;
/**
 * Description of CasionOpenedCriterion
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
class CasinoOpenedCriterion  extends PlayerTableCriterion {
    
    /**
     * 
     * @var CardManager
     */
    private $cardManager;
    
    private $fakeCasion;
    
    public function __construct(PlayerTable $table) {
        $this->cardManager = new CardManager();
        $this->fakeCasion = new \SmileLife\Card\Category\Special\Casino;
        
        parent::__construct($table);
    }
    
    /* -------------------------------------------------------------------------
     *                  BEGIN - Abstract
     * ---------------------------------------------------------------------- */

    public function isValided(): bool{
        $casino = $this->cardManager->findBy(['type'=> $this->fakeCasion->getType()]);
        
        
        var_dump($casino);die;
        
        return true;
    }


}
