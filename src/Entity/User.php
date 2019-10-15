<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\Table(name="account")
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\OneToMany(targetEntity="Baby", mappedBy="user") 
     */
    private $babies; 

    public function __construct()
    {
        $this->babies = new ArrayCollection();
    }

    /**
     * Add baby
     *
     * @param Baby $baby
     *
     * @return User
     */
    public function addBaby(Baby $baby)
    {
        $this->babies[] = $baby;

        return $this;
    }

    /**
     * Remove baby
     *
     * @param aby $baby
     */
    public function removeBaby(Baby $baby)
    {
        $this->babies->removeElement($baby);
    }

    /**
     * Get babies
     *
     * @return Collection
     */
    public function getBabies()
    {
        return $this->babies;
    }
}
