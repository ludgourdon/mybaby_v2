<?php
namespace App\Manager;

use App\Entity\User;
use App\Manager\BaseManager;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Baby;

class BabyManager extends BaseManager
{
    protected $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getRepository()
    {
        return $this->em->getRepository('MybabyMainBundle:Baby');
    }
    
    public function save(Baby $baby)
    {
        $this->persistAndFlush($baby);
    }
    
    /**
     * @param Baby $baby 
     */
    public function removeBaby(Baby $baby)
    {
        $this->remove($baby);
    }
    
    /**
     * @param int $id
     */
    public function find(int $id)
    {
        return $this->getRepository()->find($id);
    }
    
    public function hasAccessBaby($idBaby, User $user)
    {
        if ($user->isSuperAdmin()) {
            return true;
        }
        
        return $this->getRepository()->findBy(array('id' => $idBaby, 'user' => $user));
    }
}
?>
