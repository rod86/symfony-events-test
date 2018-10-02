<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * EventType
 *
 * @ORM\Table(name="event_types")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EventTypeRepository")
 */
class EventType
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="Event", mappedBy="eventType")
     */
    private $events;


    public function __construct()
    {
        $this->events = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return EventType
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    public function addEvent(Event $event)
    {
        $this->events[] = $event;

        return $this;
    }

    public function removeEvent(Event $event)
    {
        $this->events->remove($event);
    }

    public function getEvents()
    {
        return $this->events;
    }
}

