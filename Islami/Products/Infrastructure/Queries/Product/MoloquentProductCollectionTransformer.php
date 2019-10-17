<?php


namespace Islami\Products\Infrastructure\Queries\Product;


use Illuminate\Support\Collection;
use Islami\Products\Application\Queries\Product\Product;
use Islami\Shared\Application\Queries\ResponseCollectionTransformer;

class MoloquentProductCollectionTransformer implements ResponseCollectionTransformer
{

    public function handle(Collection $items): Collection
    {
        $collection = collect();
        foreach ($items as $item){
            $data = new Product(
                $item->_id,
                $item->name,
                $item->description,
                $item->price,
                $item->currency,
                $item->stock,
                $item->published_at
            );
            $collection->push($data);
        }

        return $collection;
    }
}
