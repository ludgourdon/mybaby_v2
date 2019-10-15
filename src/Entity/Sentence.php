<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Family;
use App\Entity\Baby;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SentenceRepository")
 * @ORM\Table(name="sentence")
 */
class Sentence {

     /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $sentence;
    
    /**
     * @ORM\OneToOne(targetEntity="Family", cascade={"persist"})
     */
    private $familyMember;
    
    /**
     * @ORM\ManyToOne(targetEntity="Baby", inversedBy="sentences")
     * @ORM\JoinColumn(name="baby_id", referencedColumnName="id")
     */
    private $baby;
    
    /**
     * Set sentence
     *
     * @param string $sentence
     *
     * @return Sentence
     */
    public function setSentence($sentence)
    {
        $this->sentence = $sentence;

        return $this;
    }

    /**
     * Get sentence
     *
     * @return string
     */
    public function getSentence()
    {
        return $this->sentence;
    }

    /**
     * Set familyMember
     *
     * @param Family $familyMember
     *
     * @return Sentence
     */
    public function setFamilyMember(Family $familyMember = null)
    {
        $this->familyMember = $familyMember;

        return $this;
    }

    /**
     * Get familyMember
     *
     * @return Family
     */
    public function getFamilyMember()
    {
        return $this->familyMember;
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
     * Set baby
     *
     * @param \App\Entity\Baby $baby
     *
     * @return Sentence
     */
    public function setBaby(\App\Entity\Baby $baby = null)
    {
        $this->baby = $baby;

        return $this;
    }

    /**
     * Get baby
     *
     * @return \App\Entity\Baby
     */
    public function getBaby()
    {
        return $this->baby;
    }
}
