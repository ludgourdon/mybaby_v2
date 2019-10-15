<?php
namespace App\Manager;

abstract class BaseManager
{
    protected function persistAndFlush($entity)
    {
        $this->em->persist($entity);
        $this->em->flush();
    }
    
    protected function remove($entity)
    {
        $this->em->remove($entity);
        $this->em->flush();
    }
}
?>
