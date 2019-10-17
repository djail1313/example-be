<?php


namespace Islami\Shared\Infrastructure\Persistence\Moloquent\Specification;


use Islami\Shared\Infrastructure\Persistence\Repository\Specification\SortSpecification;
use Islami\Shared\Infrastructure\Persistence\Repository\Specification\Specification;

class MoloquentSortSpecification implements SortSpecification
{

    /**
     * @var string $sort
     */
    private $sort;

    public function specify(? string $sort): Specification
    {
        $this->sort = $sort;
        return $this;
    }

    /**
     * @param mixed $query
     * @return mixed
     */
    public function getQuery($query)
    {
        $sort = $this->sort;
        if ($sort) {
            $direction = $this->setSortDirection($sort);
            if ($direction == 'desc')
                $sort = trim($sort, '-');
            $query = $query->orderBy($sort, $direction);
        }

        return $query;
    }

    protected function setSortDirection($sort)
    {
        $first_character = substr($sort, 0, 1);

        if ($first_character == '-')
            return "desc";

        return "asc";
    }
}
