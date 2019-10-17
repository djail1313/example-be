<?php


namespace Islami\Products\Application\Queries\Product\Specification;


use Islami\Shared\Infrastructure\Persistence\Repository\Specification\Specification;

interface ProductFilterSpecification extends Specification
{

    public function specify(
        int $page,
        int $per_page,
        array $filter = [],
        string $sort = null)
    : ProductFilterSpecification;

}
