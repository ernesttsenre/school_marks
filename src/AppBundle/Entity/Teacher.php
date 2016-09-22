<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="teacher")
 * @ORM\Entity
 */
class Teacher
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
     * @ORM\OneToMany(targetEntity="Mark", mappedBy="teacher")
     */
    private $marks;

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
     * @return Teacher
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
        $this->marks = new ArrayCollection();
    }

    /**
     * @param Mark $mark
     *
     * @return Teacher
     */
    public function addMark(Mark $mark)
    {
        $this->marks[] = $mark;

        return $this;
    }

    /**
     * @param Mark $mark
     */
    public function removeMark(Mark $mark)
    {
        $this->marks->removeElement($mark);
    }

    /**
     * @return Collection
     */
    public function getMarks()
    {
        return $this->marks;
    }

    /**
     * @param \DateTime $created
     *
     * @return Teacher
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
