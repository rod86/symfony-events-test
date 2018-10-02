<?php

namespace AppBundle\DataFixtures;

use AppBundle\Entity\EventType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class EventTypesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $data = $this->getData();

        foreach ($data as $key => $name) {
            $type = new EventType();
            $type->setName($name);

            $this->addReference('event-type-'.$key, $type);

            $manager->persist($type);
        }

        $manager->flush();
    }

    protected function getData()
    {
        return [
            'sport' => 'Sport',
            'cultural' => 'Cultural',
            'social' => 'Social'
        ];
    }
}