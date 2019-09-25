<?php


namespace Islami\Shared\Infrastructure\Persistence\Bus\Event\EventStore\Specification;


use Islami\Shared\Infrastructure\Persistence\Moloquent\EventStore\EventStore;
use Islami\Shared\Infrastructure\Persistence\Repository\Specification\Specification;

abstract class MoloquentBaseEventStoreSpecification implements Specification
{

    protected $model = EventStore::class;
    protected $query;

    protected function __construct()
    {
        $model_instance = new $this->model;
        $this->query = $model_instance->query();
    }

}
