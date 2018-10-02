<?php

namespace AppBundle\Services\EventService;

use AppBundle\Entity\Place;
use Doctrine\ORM\EntityManagerInterface;

class PlaceService
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getPlaces()
    {
        return $this->em->getRepository('AppBundle:Place')->findAll();
    }

    public function serializePlace(Place $place)
    {
        return [
            'id' => $place->getId(),
            'name' => $place->getName(),
            'location' => $place->getLocation()
        ];
    }
}