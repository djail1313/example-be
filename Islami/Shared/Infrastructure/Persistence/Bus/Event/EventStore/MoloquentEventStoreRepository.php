<?php


namespace Islami\Shared\Infrastructure\Persistence\Bus\Event\EventStore;


use Illuminate\Support\Collection;
use Islami\Shared\Bus\Event\DomainEvent;
use Islami\Shared\Bus\Event\EventStoreRepository;
use Islami\Shared\Bus\Event\Model;
use Islami\Shared\Bus\Event\PayloadSerializer;
use Islami\Shared\Domain\ValueObject\Id;
use Islami\Shared\Infrastructure\Persistence\Moloquent\EventStore\EventStore as MoloquentEventStore;
use Islami\Shared\Infrastructure\Persistence\Moloquent\EventStore\EventStore;
use Islami\Shared\Infrastructure\Persistence\Repository\Specification\Specification;

class MoloquentEventStoreRepository implements EventStoreRepository
{

    /**
     * @var PayloadSerializer
     */
    private $payloadSerializer;

    public function __construct(PayloadSerializer $payloadSerializer)
    {
        $this->payloadSerializer = $payloadSerializer;
    }

    public function persist(DomainEvent $domainEvent): bool
    {
        $event_store = new MoloquentEventStore();
        $event_store->_id = $domainEvent->eventId()->getId();
        $event_store->event_name = $domainEvent->eventName();
        $event_store->occured_on = $domainEvent->occuredOn();
        $event_store->data = $this->payloadSerializer->serialize($domainEvent->data());
        $event_store->aggregate_id = $domainEvent->aggregateId();
        $event_store->aggregate_name = $domainEvent->aggregateName();
        return $event_store->save();
    }

    public function query(Specification $specification = null): Collection
    {
        if ($specification === null)
            return $this->getAll();
        else
            return $this->getBySpecification($specification);
    }

    protected function getBySpecification(Specification $specification): Collection
    {
        $event_stores = $specification->getQuery()->get();
        $domain_events = collect();
        if (!$event_stores->count())
            return $domain_events;

        foreach ($event_stores as $event_store) {
            $domain_events->push(
                $this->map($event_store->toArray())
            );
        }

        return $domain_events;
    }

    protected function getAll(): Collection
    {
        $event_stores = EventStore::get();
        $domain_events = collect();
        if (!$event_stores->count())
            return $domain_events;

        foreach ($event_stores as $event_store) {
            $domain_events->push(
                $this->map($event_store)
            );
        }

        return $domain_events;
    }

    protected function map(EventStore $data): DomainEvent
    {
        return new Model(
            new Id($data->_id),
            $data->event_name,
            $data->occured_on,
            $this->payloadSerializer->deserialize($data->data),
            $data->aggregate_id,
            $data->aggregate_name
        );
    }
}
