<?php


namespace Islami\Shared\Bus\Event;


use Illuminate\Support\Collection;
use Islami\Shared\Infrastructure\Persistence\Repository\Specification\Specification;

interface EventStoreRepository
{

    public function persist(DomainEvent $domainEvent): bool ;
    public function query(Specification $specification = null): Collection;

}
