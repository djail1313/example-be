<?php


namespace Islami\Products\Application\Commands\CreateProduct;


use Islami\Products\Domain\Model\Currency;
use Islami\Products\Domain\Model\Description;
use Islami\Products\Domain\Model\Name;
use Islami\Products\Domain\Model\Price;
use Islami\Products\Domain\Model\Product;
use Islami\Products\Domain\Model\ProductRepository;
use Islami\Products\Domain\Model\Stock;
use Islami\Products\Domain\Service\CreateProduct\CreateProduct;

class CreateProductService
{

    /**
     * @var ProductRepository
     */
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function handle(CreateProduct $createProduct)
    {

        $product = new Product(
            $this->productRepository->generateId(),
            new Name($createProduct->getName()),
            new Description($createProduct->getDescription()),
            new Price($createProduct->getPrice(), new Currency($createProduct->getCurrency())),
            new Stock($createProduct->getStock()),
            $createProduct->getPublishedAt()
        );

        return $this->productRepository->save($product);

    }

}
