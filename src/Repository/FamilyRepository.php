<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;

class FamilyRepository extends EntityRepository
{
    public function findByBaby($idBaby)
    {
        $query = $this->createQueryBuilder('f')
                ->join('f.babies', 'b')
                ->where('b.id = :idBaby')
                ->setParameter('idBaby', $idBaby);

        return $query->getQuery()->getResult();
    }
}
?>