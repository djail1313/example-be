<?php


namespace Islami\Shared\Infrastructure\Persistence\Repository\Specification;


interface SortSpecification extends Specification
{

    public function specify(? string $sort): Specification;

}
