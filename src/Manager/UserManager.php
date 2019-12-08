<?php
namespace App\Manager;

use App\Entity\Baby;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class UserManager
 */
class UserManager extends BaseManager
{
    protected $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getRepository()
    {
        return $this->em->getRepository('MybabyMainBundle:User');
    }
    public function save(User $user)
    {
        $this->persistAndFlush($user);
    }

}
?>
