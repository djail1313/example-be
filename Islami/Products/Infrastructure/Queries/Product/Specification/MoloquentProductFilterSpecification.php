<?php


namespace Islami\Products\Infrastructure\Queries\Product\Specification;


use Islami\Products\Application\Queries\Product\Specification\ProductFilterFieldCriteria;
use Islami\Products\Application\Queries\Product\Specification\ProductFilterSpecification;
use Islami\Products\Infrastructure\Queries\Product\MoloquentProductCollectionTransformer;
use Islami\Shared\Infrastructure\Persistence\Moloquent\MoloquentResponsePaginator;
use Islami\Shared\Infrastructure\Persistence\Repository\Specification\SortSpecification;

class MoloquentProductFilterSpecification implements ProductFilterSpecification
{

    /**
     * @var int
     */
    private $page;
    /**
     * @var int
     */
    private $per_page;
    /**
     * @var array
     */
    private $filter;
    /**
     * @var string
     */
    private $sort;
    /**
     * @var ProductFilterFieldCriteria
     */
    private $filterFieldCriteria;
    /**
     * @var SortSpecification
     */
    private $sortSpecification;

    public function __construct(
        ProductFilterFieldCriteria $filterFieldCriteria,
        SortSpecification $sortSpecification)
    {
        $this->filterFieldCriteria = $filterFieldCriteria;
        $this->sortSpecification = $sortSpecification;
    }

    public function specify(
        int $page,
        int $per_page,
        array $filter = [],
        string $sort = null): ProductFilterSpecification
    {
        $this->page = $page;
        $this->per_page = $per_page;
        $this->filter = $filter;
        $this->sort = $sort;

        return $this;
    }

    public function getQuery($query)
    {
        foreach ($this->filter as $key_filter => $filter) {
            $query->where(
                $key_filter,
                $this->filterFieldCriteria->convert($key_filter, $filter));
        }

        $query = $this->sortSpecification->specify($this->sort)->getQuery($query);

        $result = new MoloquentResponsePaginator(
            $query,
            $this->page,
            $this->per_page,
            new MoloquentProductCollectionTransformer()
        );
        return $result;
    }

}
