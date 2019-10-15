<?php

namespace App\Event;

use Symfony\Contracts\EventDispatcher\Event;
use App\Entity\Baby;

/**
 * Baby event.
 */
class BabyEvent extends Event
{
    const BABY_DETAILS = 'baby.details';
    
    protected $baby;
    
    public function __construct(Baby $baby) 
    {
        $this->baby = $baby;
    }
    
    public function getBaby()
    {
        return $this->baby;
    }    
}
