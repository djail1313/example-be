<?php


namespace Islami\Products\Application\Queries\Product\Specification;


use Islami\Shared\Infrastructure\Persistence\Repository\Specification\FilterFieldConverter;

class ProductFilterFieldCriteria extends FilterFieldConverter
{

    public function getAvailableFilter(): array
    {
        return [
            '_id' => 'string',
            'name' => 'string',
            'description' => 'string',
            'price' => 'int',
            'stock' => 'int',
            'published_at' => 'date'
        ];
    }

}
