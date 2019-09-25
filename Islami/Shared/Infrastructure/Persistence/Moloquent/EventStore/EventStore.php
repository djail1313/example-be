<?php


namespace Islami\Shared\Infrastructure\Persistence\Moloquent\EventStore;


class EventStore extends \Moloquent
{

    protected $connection = "mongodb";
    protected $collection = "event_stores";
    protected $dates = ['updated_at', 'created_at', 'occured_on'];

}
