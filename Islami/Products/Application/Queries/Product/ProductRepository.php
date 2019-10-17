<?php


namespace Islami\Products\Application\Queries\Product;


use Islami\Shared\Infrastructure\Persistence\Repository\Specification\Specification;

interface ProductRepository
{

    public function query(Specification $specification);
    public function find(string $id): Product;

}
