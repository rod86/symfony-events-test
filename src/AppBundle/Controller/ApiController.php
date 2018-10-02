<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Event;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/api")
 */
class ApiController extends Controller
{
    /**
     * @Route("/events", name="api_events")
     * @Method({"GET"})
     */
    public function getEventsAction()
    {
        $eventService = $this->get('app.event_service');
        $events = $eventService->getEvents();

        $result = [];
        foreach ($events as $event) {
            $result[] = $eventService->serializeEvent($event);
        }

        return $this->json($result);
    }

    /**
     * @Route("/events/{id}", name="api_events_get")
     * @Method({"GET"})
     * @ParamConverter("event", class="AppBundle:Event",
     *     options={"repository_method"="findWithJoins"}
     * )
     */
    public function getEventAction(Event $event)
    {
        $eventService = $this->get('app.event_service');
        $event = $eventService->serializeEvent($event);

        return $this->json($event);
    }

    /**
     * @Route("/events", name="api_events")
     * @Method({"POST"})
     */
    public function createEventAction(Request $request)
    {
        // fetch data from request object

        // validate data

        // convert to entity

        // save and persist

        // return created event as json with 200 status
    }

    /**
     * @Route("/all", name="api_items")
     * @Method({"GET"})
     */
    public function getItemsAction()
    {
        // Events
        $eventService = $this->get('app.event_service');
        $events = $eventService->getEvents();

        $eventsResult = [];
        foreach ($events as $event) {
            $eventsResult[] = $eventService->serializeEvent($event);
        }

        // Places
        $placeService = $this->get('app.place_service');
        $places = $placeService->getPlaces();

        $placesResult = [];
        foreach ($places as $place) {
            $placesResult[] = $placeService->serializePlace($place);
        }

        // Posts
        // TODO fetch posts and serialize them

        $result = [
            'places' => $placesResult,
            'events' => $eventsResult,
            'posts' => []
        ];

        return $this->json($result);
    }
}