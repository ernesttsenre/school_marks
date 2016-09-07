<?php

namespace AppBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * Learner
 *
 * @ORM\Table(name="learner")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LearnerRepository")
 */
class Learner
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @ORM\ManyToOne(targetEntity="Parents", inversedBy="learners")
     * @ORM\JoinColumn(name="parents_id", referencedColumnName="id")
     */
    private $parents;

    /**
     * @ORM\OneToMany(targetEntity="Mark", mappedBy="learner")
     */
    private $marks;

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
     * Set title
     *
     * @param string $title
     *
     * @return Learner
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set parents
     *
     * @param \AppBundle\Entity\Parents $parents
     *
     * @return Learner
     */
    public function setParents(\AppBundle\Entity\Parents $parents = null)
    {
        $this->parents = $parents;

        return $this;
    }

    /**
     * Get parents
     *
     * @return \AppBundle\Entity\Parents
     */
    public function getParents()
    {
        return $this->parents;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->marks = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add mark
     *
     * @param \AppBundle\Entity\Mark $mark
     *
     * @return Learner
     */
    public function addMark(\AppBundle\Entity\Mark $mark)
    {
        $this->marks[] = $mark;

        return $this;
    }

    /**
     * Remove mark
     *
     * @param \AppBundle\Entity\Mark $mark
     */
    public function removeMark(\AppBundle\Entity\Mark $mark)
    {
        $this->marks->removeElement($mark);
    }

    /**
     * Get marks
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMarks()
    {
        return $this->marks;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Learner
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }
}
