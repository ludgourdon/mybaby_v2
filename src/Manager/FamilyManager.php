<?php
namespace App\Manager;

use App\Manager\BaseManager;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Family;
use App\Entity\Baby;

class FamilyManager extends BaseManager
{
    protected $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getRepository()
    {
        return $this->em->getRepository('MybabyMainBundle:Family');
    }
    
    public function save(Family $family)
    {
        $this->persistAndFlush($family);
    }
    
    /**
     * @param Family $family 
     */
    public function removeFamily(Family $family)
    {
        $this->remove($family);
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
        return $this->getRepository()->findByBaby($id);
    }
    
    public function familyUserAlreadyDefined(Baby $baby)
    {
        if (!$this->hasFamily($baby)) {
            return false;
        }
        
        foreach ($baby->getFamilies() as $family) {
            if ($family->isUser()) {
                return true;
            }
        }
        
        return false;
    }
    
    public function hasFamily(Baby $baby)
    {
        if (count($baby->getFamilies())) {
            return true;
        }
        
        return false;
    }
    /** TODO : Ajouter methodes controle de droits d'acces */
}
?>
