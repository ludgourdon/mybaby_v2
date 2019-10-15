<?php
namespace App\Manager;

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
}
?>
