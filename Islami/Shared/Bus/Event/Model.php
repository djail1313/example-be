<?php


namespace Islami\Shared\Bus\Event;


use Carbon\Carbon;
use Islami\Shared\Domain\ValueObject\Id;

class Model extends DomainEvent
{

    /**
     * @var Id
     */
    private $event_id;
    /**
     * @var Carbon
     */
    private $occured_on;
    /**
     * @var array
     */
    private $data;
    /**
     * @var string
     */
    private $event_name;
    /**
     * @var string
     */
    private $aggregate_name;
    /**
     * @var string
     */
    private $aggregate_id;

    public function __construct(
        Id $event_id,
        string $event_name,
        Carbon $occured_on,
        array $data,
        string $aggregate_id,
        string $aggregate_name
    )
    {
        parent::__construct();
        $this->event_id = $event_id;
        $this->occured_on = $occured_on;
        $this->data = $data;
        $this->event_name = $event_name;
        $this->aggregate_name = $aggregate_name;
        $this->aggregate_id = $aggregate_id;
    }

    public function data(): array
    {
        return $this->data;
    }

    public function eventName(): string
    {
        return $this->event_name;
    }

    public function aggregateName(): string
    {
        return $this->aggregate_name;
    }

    public function aggregateId(): string
    {
        return $this->aggregate_id;
    }
}
