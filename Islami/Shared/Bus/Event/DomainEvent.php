<?php


namespace Islami\Shared\Bus\Event;


use Carbon\Carbon;
use Islami\Shared\Domain\ValueObject\Id;

abstract class DomainEvent
{

    private $occured_on;
    private $event_id;

    public function __construct()
    {
        $this->occured_on = Carbon::now();
        $this->event_id = new Id();
    }

    public function occuredOn(): Carbon
    {
        return clone $this->occured_on;
    }

    /**
     * @return Id
     */
    public function eventId(): Id
    {
        return $this->event_id;
    }

    public function toArray(): array
    {
        return [
            'event_id' => $this->eventId()->getId(),
            'occured_on' => $this->occuredOn(),
            'event_name' => $this->eventName(),
            'aggregate_name' => $this->aggregateName(),
            'aggregate_id' => $this->aggregateId(),
            'data' => $this->data()
        ];
    }

    public abstract function data(): array;
    public abstract function eventName(): string;
    public abstract function aggregateName(): string;
    public abstract function aggregateId(): string;
}
