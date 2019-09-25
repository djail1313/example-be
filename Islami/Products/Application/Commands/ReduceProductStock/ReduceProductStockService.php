<?php


namespace Islami\Products\Application\Commands\ReduceProductStock;


use Islami\Products\Domain\Model\ProductRepository;
use Islami\Products\Shared\Domain\Model\Product\ProductId;
use Islami\Products\Shared\Exceptions\ProductNotFoundException;

class ReduceProductStockService
{

    /**
     * @var ProductRepository
     */
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function handle(ReduceProductStock $reduceProductStock)
    {
        $product = $this->productRepository->find(new ProductId($reduceProductStock->getId()));

        if ($product === null)
            throw new ProductNotFoundException();

        $product->reduceStock($reduceProductStock->getStock());

        $this->productRepository->save($product);
    }

}
