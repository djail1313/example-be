<?php


namespace Islami\Shared\Infrastructure\Persistence\Repository\Specification;


interface Specification
{

    /**
     * @param mixed $query
     * @return mixed
     */
    public function getQuery($query);

}
