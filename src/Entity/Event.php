<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Photo;
use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\Baby;
use Doctrine\Common\Collections\Collection;

/**
 * Event
 *
 * @ORM\Table(name="event")
 * @ORM\Entity(repositoryClass="App\Repository\EventRepository")
 */
class Event
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=true)
     */
    private $date;
    
    /**
     * @var string
     * 
     * @ORM\Column(name="place", type="string", length=255) 
     */
    private $place;

    /**
     * @ORM\ManyToOne(targetEntity="Baby", inversedBy="events")
     * @ORM\JoinColumn(name="baby_id", referencedColumnName="id")
     */
    private $baby;
    
    /**
     * @ORM\OneToMany(targetEntity="Photo", mappedBy="event")
     */
    private $photos;
    
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Event
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Event
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set baby
     *
     * @param Baby $baby
     *
     * @return Event
     */
    public function setBaby(Baby $baby = null)
    {
        $this->baby = $baby;

        return $this;
    }

    /**
     * Get baby
     *
     * @return Baby
     */
    public function getBaby()
    {
        return $this->baby;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->photos = new ArrayCollection();
    }

    /**
     * Add photo
     *
     * @param Photo $photo
     *
     * @return Event
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

    /**
     * Set place
     *
     * @param string $place
     *
     * @return Event
     */
    public function setPlace($place)
    {
        $this->place = $place;

        return $this;
    }

    /**
     * Get place
     *
     * @return string
     */
    public function getPlace()
    {
        return $this->place;
    }
}
