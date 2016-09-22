<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Subject;

class LoadSubjectData extends AbstractFixture implements OrderedFixtureInterface
{
    private $available = [
        1 => 'Физкультура',
        2 => 'Математика',
        3 => 'Биология',
        4 => 'ОБЖ',
        5 => 'Правоведение',
        6 => 'Химия',
        7 => 'Английский язык',
    ];

    public function load(ObjectManager $manager)
    {
        foreach ($this->available as $key => $title) {
            $subject = new Subject();

            $subject->setTitle($title);
            $manager->persist($subject);

            $referenceKey = sprintf('subject_%s', $key);
            $this->addReference($referenceKey, $subject);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}