<?php

namespace AppBundle\Services\EventService;

use AppBundle\Entity\Event;
use Doctrine\ORM\EntityManagerInterface;

class EventService
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var EventTypeService
     */
    private $eventTypeService;

    /**
     * @var PlaceService
     */
    private $placeService;

    public function __construct(EntityManagerInterface $em, EventTypeService $eventTypeService, PlaceService $placeService)
    {
        $this->em = $em;
        $this->eventTypeService = $eventTypeService;
        $this->placeService = $placeService;
    }

    public function getEvents()
    {
        return $this->em->getRepository('AppBundle:Event')->getEvents();
    }

    public function serializeEvent(Event $event)
    {
        $result = [
            'id' => $event->getId(),
            'name' => $event->getName(),
            'date_start' => $event->getDateStart(),
            'date_end' => $event->getDateEnd()
        ];

        $eventType = $event->getEventType();
        if ($eventType) {
            $result['event_type'] = $this->eventTypeService->serializeEventType($eventType);
        }

        $place = $event->getPlace();
        if ($place) {
            $result['place'] = $this->placeService->serializePlace($place);
        }

        return $result;
    }
}