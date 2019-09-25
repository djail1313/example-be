<?php


namespace Islami\Shared\Bus\Event;


interface EventBus
{

    public function notify(DomainEvent $event): void;

}
