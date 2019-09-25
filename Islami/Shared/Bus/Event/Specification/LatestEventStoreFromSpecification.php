<?php


namespace Islami\Shared\Bus\Event\Specification;


use Carbon\Carbon;
use Islami\Shared\Infrastructure\Persistence\Repository\Specification\Specification;

interface LatestEventStoreFromSpecification extends Specification
{

    public function __construct(Carbon $from);

}
