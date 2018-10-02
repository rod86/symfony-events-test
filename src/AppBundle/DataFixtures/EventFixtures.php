<?php

namespace AppBundle\DataFixtures;

use AppBundle\Entity\Event;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class EventFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $description = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse porttitor eget urna ac ultrices. In ac luctus leo. Sed eget elit iaculis, luctus neque vitae, auctor tortor. Sed nec eros a sem eleifend suscipit quis sit amet neque. Pellentesque rhoncus massa quis diam luctus facilisis. Donec eu bibendum enim, iaculis suscipit orci. Nulla sed commodo augue, vel ultricies urna. Duis lorem elit, maximus at lectus ac, vestibulum placerat eros.';

        $data = $this->getData();

        foreach ($data as $key => $item) {

            $event = new Event();
            $event
                ->setName($item['name'])
                ->setDateStart($item['date_start'])
                ->setDateEnd($item['date_end'])
                ->setDescription($description);

            $eventTypeRef = 'event-type-' . $item['event_type'];
            $placeRef = 'place-' . $item['place'];

            if ($this->hasReference($eventTypeRef)) {
                $eventType = $this->getReference($eventTypeRef);
                $event->setEventType($eventType);
            }

            if ($this->hasReference($placeRef)) {
                $place = $this->getReference($placeRef);
                $event->setPlace($place);
            }

            $this->addReference('event-'.$key, $event);

            $manager->persist($event);
        }

        $manager->flush();
    }

    protected function getData()
    {
        return [
             'meet-neighbours' => [
                'name' => 'Meet your neighbours',
                'date_start' => new \DateTime('2018-08-26 10:30:00'),
                'date_end' => new \DateTime('2018-08-26 10:30:00'),
                'event_type' => 'social',
                'place' => 'library'
            ],
            'reading' => [
                'name' => 'Reading Session',
                'date_start' => new \DateTime('2018-08-30 18:30:00'),
                'date_end' => new \DateTime('2018-08-30 20:00:00'),
                'event_type' => 'cultural',
                'place' => 'library'
            ],
            'yoga' => [
                'name' => 'Yoga with neighbours',
                'date_start' => new \DateTime('2018-08-30 11:00:00'),
                'date_end' => new \DateTime('2018-08-30 13:00:00'),
                'event_type' => 'sport',
                'place' => 'gym'
            ],
            'bbq' => [
                'name' => 'BBQ',
                'date_start' => new \DateTime('2018-09-02 12:00:00'),
                'date_end' => new \DateTime('2018-09-02 17:00:00'),
                'event_type' => 'social',
                'place' => 'park'
            ],
            'jazz' => [
                'name' => 'Jazz Concert',
                'date_start' => new \DateTime('2018-09-20 20:00:00'),
                'date_end' => new \DateTime('2018-09-20 23:00:00'),
                'event_type' => 'cultural',
                'place' => 'concerthall'
            ]
        ];
    }

    public function getDependencies()
    {
        return [
            EventTypesFixtures::class,
            PlaceFixtures::class
        ];
    }
}