<?php
namespace App\Manager;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Sentence;
use App\Repository\SentenceRepository;

/**
 * Description of SentenceManager
 */
class SentenceManager extends BaseManager
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
     * 
     * @return SentenceRepository
     */
    public function getRepository()
    {
        return $this->em->getRepository('MybabyMainBundle:Sentence');
    }
    
    /**
     * 
     * @param Sentence $sentence
     */
    public function save(Sentence $sentence)
    {
        $this->persistAndFlush($sentence);
    }
    
    /**
     * @param Sentence $sentence 
     */
    public function removeBaby(Sentence $sentence)
    {
        $this->remove($sentence);
    }
    
    /**
     * @param int $id
     */
    public function find($id)
    {
        return $this->getRepository()->find($id);
    }
}
