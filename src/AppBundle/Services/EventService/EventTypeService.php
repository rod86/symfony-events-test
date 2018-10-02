<?php

namespace AppBundle\Services\EventService;

use AppBundle\Entity\EventType;
use Doctrine\ORM\EntityManagerInterface;

class EventTypeService
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getEventTypes()
    {
        return $this->em->getRepository('AppBundle:EventType')->findAll();
    }

    public function serializeEventType(EventType $eventType)
    {
        return [
            'id' => $eventType->getId(),
            'name' => $eventType->getName()
        ];
    }
}