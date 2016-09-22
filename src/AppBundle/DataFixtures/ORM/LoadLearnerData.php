<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Learner;

class LoadLearnerData extends AbstractFixture implements OrderedFixtureInterface
{
    private $available = [
        1 => [
            'title' => 'Зинкович Игнат Александрович',
            'mother' => 1
        ],
        2 => [
            'title' => 'Зинкович Юлия Владимировна',
            'mother' => 2
        ],
        3 => [
            'title' => 'Линник Юрий Сергеевич',
            'mother' => 1
        ],
        4 => [
            'title' => 'Линник Ольга Александровна',
            'mother' => 2
        ],
    ];

    public function load(ObjectManager $manager)
    {
        foreach ($this->available as $key => $data) {
            list($title, $motherId) = array_values($data);
            $motherKey = sprintf('mother_%s', $motherId);

            $learner = new Learner();

            $learner->setTitle($title);
            $learner->setMother(
                $this->getReference($motherKey)
            );
            $manager->persist($learner);

            $referenceKey = sprintf('learner_%s', $key);
            $this->addReference($referenceKey, $learner);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 4;
    }
}