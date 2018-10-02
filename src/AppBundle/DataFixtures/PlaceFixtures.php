<?php

namespace AppBundle\DataFixtures;

use AppBundle\Entity\Place;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class PlaceFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $data = $this->getData();

        foreach ($data as $key => $item) {
            $place = new Place();
            $place
                ->setName($item['name'])
                ->setLocation($item['location']);

            $this->addReference('place-'.$key, $place);

            $manager->persist($place);
        }

        $manager->flush();
    }

    protected function getData()
    {
        return [
            'concerthall' => [
                'name' => 'Concert Hall',
                'location' => 'c/ falsa, 23, 08000'
            ],
            'gym' => [
                'name' => 'Gym',
                'location' => 'c/ falsa, 23, 08000'
            ],
            'library' => [
                'name' => 'Local Library',
                'location' => 'c/ falsa, 23, 08000'
            ],
            'park' => [
                'name' => 'Test Park',
                'location' => 'c/ falsa, 23, 08000'
            ]
        ];
    }
}