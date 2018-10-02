<?php

namespace AppBundle\DataFixtures;

use AppBundle\Entity\Event;
use AppBundle\Entity\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class PostFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $comment = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse porttitor eget urna ac ultrices. In ac luctus leo. Sed eget elit iaculis, luctus neque vitae, auctor tortor. Sed nec eros a sem eleifend suscipit quis sit amet neque. Pellentesque rhoncus massa quis diam luctus facilisis. Donec eu bibendum enim, iaculis suscipit orci. Nulla sed commodo augue, vel ultricies urna. Duis lorem elit, maximus at lectus ac, vestibulum placerat eros.';

        $data = $this->getData();

        foreach ($data as $key => $item) {

            $post = new Post();
            $post
                ->setComment('#' . $key . ' ' . $comment)
                ->setDate($item['date']);

            $eventRef = $item['event'];
            if ($this->hasReference($eventRef)) {
                $event = $this->getReference($eventRef);
                $post->setEvent($event);
            }

            $manager->persist($post);
        }

        $manager->flush();
    }

    protected function getData()
    {
        return [
            [
                'event' => 'jazz',
                'date' =>  new \DateTime('2018-08-26 10:30:00')
            ],
            [
                'event' => 'jazz',
                'date' =>  new \DateTime('2018-08-26 13:30:00')
            ],
            [
                'event' => 'jazz',
                'date' =>  new \DateTime('2018-08-26 14:30:00')
            ],
            [
                'event' => 'jazz',
                'date' =>  new \DateTime('2018-08-26 15:30:00')
            ],
            [
                'event' => 'jazz',
                'date' =>  new \DateTime('2018-08-26 16:30:00')
            ],
            [
                'event' => 'jazz',
                'date' =>  new \DateTime('2018-08-27 17:30:00')
            ]
        ];
    }

    public function getDependencies()
    {
        return [
            EventFixtures::class
        ];
    }
}