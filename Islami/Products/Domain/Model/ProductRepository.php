<?php


namespace Islami\Products\Domain\Model;


use Islami\Products\Shared\Domain\Model\Product\ProductId;

interface ProductRepository
{

    public function generateId(): ProductId;
    public function save(Product $product): bool;
    public function find(ProductId $id):? Product;

}
