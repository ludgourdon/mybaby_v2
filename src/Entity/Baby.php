<?php
namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BabyRepository")
 * @ORM\Table(name="baby")
 * @UniqueEntity(fields={"lastName", "firstName", "user"}, message="Bébé est déjà enregistré")
 */
class Baby
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    private $lastName;
    
    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    private $firstName;
    
    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $nickName;

    /**
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    private $sex;
    
    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $firstStepDate;
    
    /**
     * @ORM\Column(type="datetime", nullable=true) 
     */
    private $baptismDate;
    
    /**
     * @ORM\Column(type="string", length=50, nullable=true) 
     */
    private $hairColor;
    
    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $secondName;
    
    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $thirdName;
    
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="babies", fetch="EAGER")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;
    
    /**
     * @ORM\OneToMany(targetEntity="Event", mappedBy="baby", cascade={"persist", "remove"})
     */
    private $events;
    
    /**
    * @var ArrayCollection
    *
    * @ORM\ManyToMany(targetEntity="Family", inversedBy="babies", cascade={"persist"})
    * @ORM\JoinTable(name="baby_family",
    *      joinColumns={@ORM\JoinColumn(name="baby_id", referencedColumnName="id")},
    *      inverseJoinColumns={@ORM\JoinColumn(name="family_id", referencedColumnName="id")})
    */
   private $families;
    
     /**
     * @ORM\OneToMany(targetEntity="Sentence", mappedBy="baby", cascade={"persist", "remove"})
     */
    private $sentences;
    
    /**
     * @ORM\OneToMany(targetEntity="Photo", mappedBy="baby")
     */
    private $photos;

    /**
     * One birth is for has One baby.
     * @ORM\OneToOne(targetEntity="Birth", mappedBy="baby")
     */
    private $birth;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->events = new ArrayCollection();
        $this->families = new ArrayCollection();
        $this->sentences = new ArrayCollection();
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
     * Set lastName
     *
     * @param string $lastName
     *
     * @return Baby
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return Baby
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set sex
     *
     * @param string $sex
     *
     * @return Baby
     */
    public function setSex($sex)
    {
        $this->sex = $sex;

        return $this;
    }

    /**
     * Get sex
     *
     * @return string
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * Set birthHour
     *
     * @param \DateTime $birthHour
     *
     * @return Baby
     */
    public function setBirthHour($birthHour)
    {
        $this->birthHour = $birthHour;

        return $this;
    }

    /**
     * Set firstStepDate
     *
     * @param \DateTime $firstStepDate
     *
     * @return Baby
     */
    public function setFirstStepDate($firstStepDate)
    {
        $this->firstStepDate = $firstStepDate;

        return $this;
    }

    /**
     * Get firstStepDate
     *
     * @return \DateTime
     */
    public function getFirstStepDate()
    {
        return $this->firstStepDate;
    }

    /**
     * Set baptismDate
     *
     * @param \DateTime $baptismDate
     *
     * @return Baby
     */
    public function setBaptismDate($baptismDate)
    {
        $this->baptismDate = $baptismDate;

        return $this;
    }

    /**
     * Get baptismDate
     *
     * @return \DateTime
     */
    public function getBaptismDate()
    {
        return $this->baptismDate;
    }

    /**
     * Set hairColor
     *
     * @param string $hairColor
     *
     * @return Baby
     */
    public function setHairColor($hairColor)
    {
        $this->hairColor = $hairColor;

        return $this;
    }

    /**
     * Get hairColor
     *
     * @return string
     */
    public function getHairColor()
    {
        return $this->hairColor;
    }

    /**
     * Set secondName
     *
     * @param string $secondName
     *
     * @return Baby
     */
    public function setSecondName($secondName)
    {
        $this->secondName = $secondName;

        return $this;
    }

    /**
     * Get secondName
     *
     * @return string
     */
    public function getSecondName()
    {
        return $this->secondName;
    }

    /**
     * Set thirdName
     *
     * @param string $thirdName
     *
     * @return Baby
     */
    public function setThirdName($thirdName)
    {
        $this->thirdName = $thirdName;

        return $this;
    }

    /**
     * Get thirdName
     *
     * @return string
     */
    public function getThirdName()
    {
        return $this->thirdName;
    }

    /**
     * Set user
     *
     * @param User $user
     *
     * @return Baby
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
     * Add event
     *
     * @param Event $event
     *
     * @return Baby
     */
    public function addEvent(Event $event)
    {
        $this->events[] = $event;

        return $this;
    }

    /**
     * Remove event
     *
     * @param Event $event
     */
    public function removeEvent(Event $event)
    {
        $this->events->removeElement($event);
    }

    /**
     * Get events
     *
     * @return Collection
     */
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * Set nickName
     *
     * @param string $nickName
     *
     * @return Baby
     */
    public function setNickName($nickName)
    {
        $this->nickName = $nickName;

        return $this;
    }

    /**
     * Get nickName
     *
     * @return string
     */
    public function getNickName()
    {
        return $this->nickName;
    }

    /**
     * Add family
     *
     * @param Family $family
     *
     * @return Baby
     */
    public function addFamily(Family $family)
    {
        $this->families[] = $family;

        return $this;
    }

    /**
     * Remove family
     *
     * @param Family $family
     */
    public function removeFamily(Family $family)
    {
        $this->families->removeElement($family);
    }

    /**
     * Get families
     *
     * @return Collection
     */
    public function getFamilies()
    {
        return $this->families;
    }

    /**
     * Add sentence
     *
     * @param Sentence $sentence
     *
     * @return Baby
     */
    public function addSentence(Sentence $sentence)
    {
        $this->sentences[] = $sentence;

        return $this;
    }

    /**
     * Remove sentence
     *
     * @param Sentence $sentence
     */
    public function removeSentence(Sentence $sentence)
    {
        $this->sentences->removeElement($sentence);
    }

    /**
     * Get sentences
     *
     * @return Collection
     */
    public function getSentences()
    {
        return $this->sentences;
    }

    /**
     * Add photo
     *
     * @param Photo $photo
     *
     * @return Baby
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

    public function getBirth(): ?Birth
    {
        return $this->birth;
    }

    public function setBirth(?Birth $birth): self
    {
        $this->birth = $birth;

        // set (or unset) the owning side of the relation if necessary
        $newBaby = $birth === null ? null : $this;
        if ($newBaby !== $birth->getBaby()) {
            $birth->setBaby($newBaby);
        }

        return $this;
    }
}
