<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Teacher;

class LoadTeacherData extends AbstractFixture implements OrderedFixtureInterface
{
    private $available = [
        1 => 'Борисов Владимир Петрович',
        2 => 'ПолтавскаяМария Сергеевна',
        3 => 'Шевчук Александр Петрович',
    ];

    public function load(ObjectManager $manager)
    {
        foreach ($this->available as $key => $title) {
            $teacher = new Teacher();

            $teacher->setTitle($title);
            $manager->persist($teacher);

            $referenceKey = sprintf('teacher_%s', $key);
            $this->addReference($referenceKey, $teacher);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}