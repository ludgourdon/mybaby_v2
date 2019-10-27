<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BirthRepository")
 * @ORM\Table(name="birth")
 */
class Birth
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * One baby has One birth.
     * @ORM\OneToOne(targetEntity="Baby", inversedBy="birth")
     * @ORM\JoinColumn(name="baby_id", referencedColumnName="id")
     */
    private $baby;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $birthDate;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $birthPlace;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $birthHour;

    /**
     * @ORM\Column(type="decimal", precision=3, scale=2, nullable=true)
     */
    private $birthHeight;

    /**
     * @ORM\Column(type="decimal", precision=4, scale=3, nullable=true)
     */
    private $birthWeight;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $eyeColor;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $hairy;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $hairColor;

    /**
     * One birth concern one event
     *
     * @ORM\OneToOne(targetEntity="Event", inversedBy="birth")
     * @ORM\JoinColumn(name="event_id", referencedColumnName="id")
     */
    private $event;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $whoImLookingLike;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $whyDoILookLike;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $comments;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birthDate;
    }

    public function setBirthDate(?\DateTimeInterface $birthDate): self
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    public function getBirthPlace(): ?string
    {
        return $this->birthPlace;
    }

    public function setBirthPlace(?string $birthPlace): self
    {
        $this->birthPlace = $birthPlace;

        return $this;
    }

    public function getBirthHour(): ?\DateTimeInterface
    {
        return $this->birthHour;
    }

    public function setBirthHour(?\DateTimeInterface $birthHour): self
    {
        $this->birthHour = $birthHour;

        return $this;
    }

    public function getBirthHeight(): ?string
    {
        return $this->birthHeight;
    }

    public function setBirthHeight(?string $birthHeight): self
    {
        $this->birthHeight = $birthHeight;

        return $this;
    }

    public function getBirthWeight(): ?string
    {
        return $this->birthWeight;
    }

    public function setBirthWeight(?string $birthWeight): self
    {
        $this->birthWeight = $birthWeight;

        return $this;
    }

    public function getEyeColor(): ?string
    {
        return $this->eyeColor;
    }

    public function setEyeColor(?string $eyeColor): self
    {
        $this->eyeColor = $eyeColor;

        return $this;
    }

    public function getHairy(): ?string
    {
        return $this->hairy;
    }

    public function setHairy(?string $hairy): self
    {
        $this->hairy = $hairy;

        return $this;
    }

    public function getHairColor(): ?string
    {
        return $this->hairColor;
    }

    public function setHairColor(?string $hairColor): self
    {
        $this->hairColor = $hairColor;

        return $this;
    }

    public function getWhoImLookingLike(): ?string
    {
        return $this->whoImLookingLike;
    }

    public function setWhoImLookingLike(?string $whoImLookingLike): self
    {
        $this->whoImLookingLike = $whoImLookingLike;

        return $this;
    }

    public function getWhyDoILookLike(): ?string
    {
        return $this->whyDoILookLike;
    }

    public function setWhyDoILookLike(?string $whyDoILookLike): self
    {
        $this->whyDoILookLike = $whyDoILookLike;

        return $this;
    }

    public function getComments(): ?string
    {
        return $this->comments;
    }

    public function setComments(?string $comments): self
    {
        $this->comments = $comments;

        return $this;
    }

    public function getBaby(): ?Baby
    {
        return $this->baby;
    }

    public function setBaby(?Baby $baby): self
    {
        $this->baby = $baby;

        // set (or unset) the owning side of the relation if necessary
        $newBirth = $baby === null ? null : $this;
        if ($newBirth !== $baby->getBirth()) {
            $baby->setBirth($newBirth);
        }

        return $this;
    }

    public function getEvent(): ?Event
    {
        return $this->event;
    }

    public function setEvent(?Event $event): self
    {
        $this->event = $event;

        // set (or unset) the owning side of the relation if necessary
        $newBirth = $event === null ? null : $this;
        if ($newBirth !== $event->getBirth()) {
            $event->setBirth($newBirth);
        }

        return $this;
    }

}