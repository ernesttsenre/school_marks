<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Mother;

class LoadMotherData extends AbstractFixture implements OrderedFixtureInterface
{
    private $available = [
        1 => 'Иванова Татьяна Сергеевна',
        2 => 'Линник Ольга Павловна',
    ];

    public function load(ObjectManager $manager)
    {
        foreach ($this->available as $key => $title) {
            $mother = new Mother();

            $mother->setTitle($title);
            $manager->persist($mother);

            $referenceKey = sprintf('mother_%s', $key);
            $this->addReference($referenceKey, $mother);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 3;
    }
}