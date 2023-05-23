<?php

namespace SmileLife\Card\Consequence\Category\Studies;

use SmileLife\Card\Category\Studies\Studies;
use SmileLife\Card\Consequence\Consequence;

/**
 * Description of StudiesConsequence
 *
 * @author Mr_Kywar mr_kywar@gmail.com
 */
abstract class StudiesConsequence extends Consequence{
    /**
     * 
     * @var Studies
     */
    private $studies;


    public function __construct(Studies $card) {
        $this->studies = $card;
    }
    
    public function getStudies(): Studies {
        return $this->studies;
    }


}
