<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\Baby;
use App\Entity\User;
use App\Entity\Photo;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FamilyRepository")
 * @ORM\Table(name="family")
 */
class Family
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    private $lastname;
    
    /**
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    private $firstname;
    
    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $birthdate;
    
    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $birthplace;
    
    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $role;
    
    /**
     * @ORM\OneToOne(targetEntity="User", cascade={"persist"})
     */
    private $user;
        
    /**
    * @ORM\ManyToMany(targetEntity="Baby", mappedBy="families", cascade={"persist"})
    * @ORM\JoinTable(name="baby_family",
    *      joinColumns={@ORM\JoinColumn(name="family_id", referencedColumnName="id")},
    *      inverseJoinColumns={@ORM\JoinColumn(name="baby_id", referencedColumnName="id")})
    */
   private $babies;
    
    /**
     * @ORM\OneToMany(targetEntity="Photo", mappedBy="family")
     */
    private $photos;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->babies = new ArrayCollection();
        $this->photos = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return Family
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     *
     * @return Family
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set birthdate
     *
     * @param \DateTime $birthdate
     *
     * @return Family
     */
    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    /**
     * Get birthdate
     *
     * @return \DateTime
     */
    public function getBirthdate()
    {
        return $this->birthdate;
    }

    /**
     * Set birthplace
     *
     * @param string $birthplace
     *
     * @return Family
     */
    public function setBirthplace($birthplace)
    {
        $this->birthplace = $birthplace;

        return $this;
    }

    /**
     * Get birthplace
     *
     * @return string
     */
    public function getBirthplace()
    {
        return $this->birthplace;
    }

    /**
     * Set role
     *
     * @param string $role
     *
     * @return Family
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set user
     *
     * @param User $user
     *
     * @return Family
     */
    public function setUser(User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }
    
    /**
     * @return bool
     */
    public function isUser()
    {
        return $this->user !== null;
    }

    /**
     * Add baby
     *
     * @param Baby $baby
     *
     * @return Family
     */
    public function addBaby(Baby $baby)
    {
        $baby->addFamily($this);
        $this->babies[] = $baby;

        return $this;
    }

    /**
     * Remove baby
     *
     * @param Baby $baby
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

    /**
     * Add photo
     *
     * @param Photo $photo
     *
     * @return Family
     */
    public function addPhoto(Photo $photo)
    {
        $this->photos[] = $photo;

        return $this;
    }

    /**
     * Remove photo
     *
     * @param Photo $photo
     */
    public function removePhoto(Photo $photo)
    {
        $this->photos->removeElement($photo);
    }

    /**
     * Get photos
     *
     * @return Collection
     */
    public function getPhotos()
    {
        return $this->photos;
    }
}
