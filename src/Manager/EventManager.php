<?php
namespace App\Manager;

use App\Manager\BaseManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use App\Entity\Event;

/**
 * class event Manager.
 */
class EventManager extends BaseManager
{
    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @return EntityRepository
     */
    public function getRepository()
    {
        return $this->em->getRepository('MybabyMainBundle:Event');
    }
    
    /**
     * Save event
     * 
     * @param Event $event
     */
    public function save(Event $event)
    {
        $this->persistAndFlush($event);
    }
      
    /**
     * @param int $id
     */
    public function find($id)
    {
        return $this->getRepository()->find($id);
    }
    
    /**
     * @param int $id
     */
    public function findByBaby($id)
    {
        return $this->getRepository()->findBy(array('baby' => $id));
    }
}
?>
