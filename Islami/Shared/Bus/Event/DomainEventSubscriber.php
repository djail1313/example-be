<?php


namespace Islami\Shared\Bus\Event;


interface DomainEventSubscriber
{

    public static function subscribedTo(): array;

}
