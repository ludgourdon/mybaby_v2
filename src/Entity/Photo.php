<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Entity\Baby;
use App\Entity\Family;

/**
 * Photo
 *
 * @ORM\Table(name="photo")
 * @ORM\Entity(repositoryClass="App\Repository\PhotoRepository")
 * 
 * @Vich\Uploadable
 */
class Photo
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
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */
    private $image;
    
    /** @Vich\UploadableField(mapping="photo", fileNameProperty="image", size="imageSize")
     * 
     * @var File
     */
    private $imageFile;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=255, unique=true)
     */
    private $path;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=true)
     */
    private $date;
    
    /**
     * @ORM\Column(name="image_size", type="integer")
     *
     * @var integer
     */
    private $imageSize;

    /**
     * @ORM\Column(name="updated_at", type="datetime")
     *
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity="Event", inversedBy="photos")
     * @ORM\JoinColumn(name="event_id", referencedColumnName="id")
     */
    private $event;
    
    /**
     * @ORM\ManyToOne(targetEntity="Family", inversedBy="photos")
     * @ORM\JoinColumn(name="family_id", referencedColumnName="id")
     */
    private $family;

    /**
     * @ORM\ManyToOne(targetEntity="Baby", inversedBy="photos")
     * @ORM\JoinColumn(name="baby_id", referencedColumnName="id")
     */
    private $baby;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="profile_picture", type="boolean", nullable=false, options={"default":false})
     */
    private $profilePicture = false;

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
     * Set path
     *
     * @param string $path
     *
     * @return Photo
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Photo
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
     * @param File|null $image
     *
     * @return $this
     *
     * @throws \Exception
     */
    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
        
        return $this;
    }
    /**
     * @return File|null
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * Set imageSize
     *
     * @param integer $imageSize
     *
     * @return Photo
     */
    public function setImageSize($imageSize)
    {
        $this->imageSize = $imageSize;

        return $this;
    }

    /**
     * Get imageSize
     *
     * @return integer
     */
    public function getImageSize()
    {
        return $this->imageSize;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Photo
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set event
     *
     * @param Event $event
     *
     * @return Photo
     */
    public function setEvent(Event $event = null)
    {
        $this->event = $event;

        return $this;
    }

    /**
     * Get event
     *
     * @return Event
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return Photo
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set family
     *
     * @param Family $family
     *
     * @return Photo
     */
    public function setFamily(Family $family = null)
    {
        $this->family = $family;

        return $this;
    }

    /**
     * Get family
     *
     * @return Family
     */
    public function getFamily()
    {
        return $this->family;
    }

    /**
     * Set baby
     *
     * @param Baby $baby
     *
     * @return Photo
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
     * Set profilePicture
     *
     * @param boolean $profilePicture
     *
     * @return Photo
     */
    public function setProfilePicture($profilePicture)
    {
        $this->profilePicture = $profilePicture;

        return $this;
    }

    /**
     * Get profilePicture
     *
     * @return boolean
     */
    public function getProfilePicture()
    {
        return $this->profilePicture;
    }
}
