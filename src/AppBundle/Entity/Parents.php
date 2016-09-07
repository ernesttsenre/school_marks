<?php

namespace AppBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * Parents
 *
 * @ORM\Table(name="parents")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ParentsRepository")
 */
class Parents
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
     * @ORM\OneToMany(targetEntity="Learner", mappedBy="parents")
     */
    private $learners;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $created;


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
     * @return Parents
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
     * Constructor
     */
    public function __construct()
    {
        $this->learners = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add learner
     *
     * @param \AppBundle\Entity\Learner $learner
     *
     * @return Parents
     */
    public function addLearner(\AppBundle\Entity\Learner $learner)
    {
        $this->learners[] = $learner;

        return $this;
    }

    /**
     * Remove learner
     *
     * @param \AppBundle\Entity\Learner $learner
     */
    public function removeLearner(\AppBundle\Entity\Learner $learner)
    {
        $this->learners->removeElement($learner);
    }

    /**
     * Get learners
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLearners()
    {
        return $this->learners;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Parents
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
