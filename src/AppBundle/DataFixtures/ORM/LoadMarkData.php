<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Mark;

class LoadMothersData extends AbstractFixture implements OrderedFixtureInterface
{
    private $available = [
        [5, 1, 1, 1, 'monday this week'],
        [4, 1, 2, 2, 'monday this week'],
        [3, 1, 3, 3, 'monday previous week'],
        [2, 1, 1, 4, 'monday previous week'],
        [3, 1, 2, 5, 'monday this week'],
        [2, 1, 3, 6, 'monday this week'],
        [5, 1, 1, 7, 'monday this week'],
        [5, 2, 1, 7, 'monday this week'],
        [5, 3, 1, 7, 'monday this week'],
    ];

    public function load(ObjectManager $manager)
    {
        foreach ($this->available as $data) {
            list($markNumber, $learnerId, $teacherId, $subjectId, $dateTimeString) = $data;

            $mark = new Mark();
            $mark->setMark($markNumber);

            $learnerKey = sprintf('learner_%s', $learnerId);
            $mark->setLearner(
                $this->getReference($learnerKey)
            );

            $teacherKey = sprintf('teacher_%s', $teacherId);
            $mark->setTeacher(
                $this->getReference($teacherKey)
            );

            $subjectKey = sprintf('subject_%s', $subjectId);
            $mark->setSubject(
                $this->getReference($subjectKey)
            );

            $date = new \DateTime($dateTimeString);
            $mark->setCreated($date);

            $manager->persist($mark);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 5;
    }
}