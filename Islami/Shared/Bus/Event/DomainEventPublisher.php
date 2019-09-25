<?php


namespace Islami\Shared\Bus\Event;


class DomainEventPublisher
{

    private static $domain_event_publisher;
    private $domain_events = [];

    private function __construct()
    {
    }

    public static function instance(): DomainEventPublisher
    {
        if (! self::$domain_event_publisher instanceof DomainEventPublisher) {
            self::$domain_event_publisher = new self();
        }
        return self::$domain_event_publisher;
    }

    public function record(DomainEvent $domain_event): void
    {
        $this->domain_events[$domain_event->eventName()] = $domain_event;
    }

    public function publishRecorded(): void
    {
        $domain_events = $this->pullDomainEvents();
        foreach ($domain_events as $domain_event) {
            event($domain_event);
        }
    }

    public function pullDomainEvents(): array
    {
        $domain_events = $this->domain_events;
        $this->domain_events = [];
        return $domain_events;
    }

    public function publish(DomainEvent $domain_event): void
    {
        event($domain_event);
    }

    public function size(): int
    {
        return count($this->domain_events);
    }

}
