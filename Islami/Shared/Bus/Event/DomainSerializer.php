<?php


namespace Islami\Shared\Bus\Event;


interface DomainSerializer
{
    public function serialize(DomainEvent $event): string;
    public function deserialize(string $data): DomainEvent;
}
