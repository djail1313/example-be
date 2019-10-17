<?php


namespace Islami\Products\Infrastructure\Queries\Product;


use Islami\Products\Application\Queries\Product\Product;
use Islami\Products\Application\Queries\Product\ProductRepository;
use Islami\Shared\Infrastructure\Persistence\Moloquent\Product\MoloquentProduct;
use Islami\Shared\Infrastructure\Persistence\Repository\Specification\Specification;

class MoloquentProductRepository implements ProductRepository
{

    public function query(? Specification $specification)
    {
        if (! $specification)
            return $this->queryWithoutSpecification();
        else
            return $this->queryWithSpecification($specification);
    }

    public function queryWithSpecification(Specification $specification)
    {
        $query = MoloquentProduct::query();
        return $specification->getQuery($query);
    }

    public function queryWithoutSpecification()
    {
        $collection = new MoloquentProductCollectionTransformer();
        return $collection->handle(MoloquentProduct::all());
    }

    public function find(string $id): Product
    {
        $moloquent_product = MoloquentProduct::find($id);

        if (! $moloquent_product)
            return null;

        return $this->mapMoloquentToModel($moloquent_product);

    }

    protected function mapMoloquentToModel($moloquent)
    {
        return new Product(
            $moloquent->_id,
            $moloquent->name,
            $moloquent->description,
            $moloquent->price,
            $moloquent->currency,
            $moloquent->stock,
            $moloquent->published_at
        );
    }
}
