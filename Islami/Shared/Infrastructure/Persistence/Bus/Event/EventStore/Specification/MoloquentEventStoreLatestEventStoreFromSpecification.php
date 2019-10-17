<?php


namespace Islami\Shared\Infrastructure\Persistence\Bus\Event\EventStore\Specification;


use Carbon\Carbon;
use Islami\Shared\Bus\Event\Specification\LatestEventStoreFromSpecification;

class MoloquentEventStoreLatestEventStoreFromSpecification
    extends MoloquentBaseEventStoreSpecification
    implements LatestEventStoreFromSpecification
{

    /**
     * @var Carbon
     */
    private $from;

    public function __construct(Carbon $from)
    {
        parent::__construct();
        $this->from = $from;
    }

    public function getQuery($query)
    {
        return $query->where('occured_on', '>=', $this->from);
    }
}
