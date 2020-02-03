<?php
namespace App\Manager;

use App\Entity\Baby;
use App\Manager\BaseManager;
use App\Repository\PhotoRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Photo;
use Doctrine\ORM\EntityRepository;

/**
 * class photo manager.
 */
class PhotoManager extends BaseManager
{
    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * Constructor.
     * 
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * Get photo repository
     * 
     * @return PhotoRepository
     */
    public function getRepository()
    {
        return $this->em->getRepository(Photo::class);
    }
    
    /**
     * Save photo.
     * 
     * @param Photo $photo
     */
    public function save(Photo $photo)
    {
        $this->persistAndFlush($photo);
    }
    
    /**
     * @param int $id
     */
    public function findByEvent($id)
    {
        return $this->getRepository()->findBy(array('event' => $id));
    }

    /**
     * @param Baby $baby
     *
     * @return mixed
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findBabyProfilePicture(Baby $baby)
    {
        return $this->getRepository()->findBabyProfilePicture($baby)->getOneOrNullResult();
    }
}
?>
