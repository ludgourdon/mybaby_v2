<?php
namespace App\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use App\Event\BabyEvent;

/**
 * 
 */
class BabySubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return array(
            BabyEvent::BABY_DETAILS => 'onBabyDetails',
            );
    }
    
    public function onBabyDetails(BabyEvent $event)
    {
       
    }   
    
    public function onKernelRequest()
    {
        die('it works');
    }
}
