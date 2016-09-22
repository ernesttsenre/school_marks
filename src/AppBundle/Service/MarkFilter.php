<?php

namespace AppBundle\Service;

use AppBundle\Entity\Subject;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Form;

class MarkFilter
{
    /**
     * @var \DateTime
     */
    protected $currentWeek;

    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var Subject|null
     */
    protected $subject;

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->currentWeek = new \DateTime('monday this week');
        $this->entityManager = $entityManager;
        $this->subject = null;
    }

    /**
     * @param integer $motherId
     * @param integer|null $subjectId
     * @param Form $form
     * @return array
     */
    public function getMarks($motherId, $subjectId, Form $form)
    {
        if ($form->isSubmitted() && $form->isValid()) {
            $filterMark = $form->get('filter')->getData();
            if ($filterMark) {
                $subjectId = $filterMark->getSubject()->getId();
            }
        }

        if (!is_null($subjectId)) {
            $this->subject = $this->entityManager->getRepository('AppBundle:Subject')
                ->find($subjectId);
        }

        return $this->entityManager
            ->getRepository('AppBundle:Mark')
            ->findByParentsAndSubject($this->currentWeek, $motherId, $subjectId);
    }

    /**
     * @return \DateTime
     */
    public function getCurrentWeek()
    {
        return $this->currentWeek;
    }

    /**
     * @return Subject
     */
    public function getSubject()
    {
        return $this->subject;
    }
}