<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="mother")
 * @ORM\Entity
 */
class Mother
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @ORM\OneToMany(targetEntity="Learner", mappedBy="mother")
     */
    private $learners;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $created;


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $title
     *
     * @return Mother
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
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
        $this->learners = new ArrayCollection();
    }

    /**
     * @param Learner $learner
     *
     * @return Mother
     */
    public function addLearner(Learner $learner)
    {
        $this->learners[] = $learner;

        return $this;
    }

    /**
     * @param Learner $learner
     */
    public function removeLearner(Learner $learner)
    {
        $this->learners->removeElement($learner);
    }

    /**
     * @return Collection
     */
    public function getLearners()
    {
        return $this->learners;
    }

    /**
     * @param \DateTime $created
     *
     * @return Mother
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }
}
