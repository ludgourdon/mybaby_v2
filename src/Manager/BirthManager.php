<?php

namespace App\Manager;

use App\Entity\Birth;
use App\Repository\BirthRepository;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;

class BirthManager extends BaseManager
{
    /**
     * @var EntityManagerInterface
     */
    protected $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @return BirthRepository|ObjectRepository
     */
    public function getRepository()
    {
        return $this->em->getRepository(Birth::class);
    }

    /**
     * @param Birth $birth
     */
    public function save(Birth $birth)
    {
        $this->persistAndFlush($birth);
    }

    /**
     * @param Birth $birth
     */
    public function removeBirth(Birth $birth)
    {
        $this->remove($birth);
    }

    /**
     * @param int $id
     * @return object|null
     */
    public function find(int $id)
    {
        return $this->getRepository()->find($id);
    }
}