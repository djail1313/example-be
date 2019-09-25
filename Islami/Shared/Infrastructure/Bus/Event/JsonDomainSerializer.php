<?php


namespace Islami\Shared\Infrastructure\Bus\Event;


use Carbon\Carbon;
use Islami\Shared\Bus\Event\DomainEvent;
use Islami\Shared\Bus\Event\DomainSerializer;
use Islami\Shared\Bus\Event\Model;
use Islami\Shared\Domain\ValueObject\Id;

class JsonDomainSerializer implements DomainSerializer
{

    public function serialize(DomainEvent $event): string
    {
        return json_encode($event);
    }

    public function deserialize(string $data): DomainEvent
    {
        $data = json_decode($data);
        return new Model(
            new Id($data['event_id']),
            $data['event_name'],
            Carbon::createFromTimeString($data['occured_on']),
            $data['data'],
            $data['aggregate_id'],
            $data['aggregate_name']
        );
    }
}
