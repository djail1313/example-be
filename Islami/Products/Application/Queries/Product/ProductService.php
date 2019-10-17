<?php


namespace Islami\Products\Application\Queries\Product;

use Islami\Products\Application\Queries\Product\Specification\ProductFilterSpecification;

class ProductService
{

    /**
     * @var ProductRepository
     */
    private $productRepository;
    /**
     * @var ProductFilterSpecification
     */
    private $productFilterSpecification;

    public function __construct(
        ProductRepository $productRepository,
        ProductFilterSpecification $productFilterSpecification)
    {
        $this->productRepository = $productRepository;
        $this->productFilterSpecification = $productFilterSpecification;
    }

    public function get(int $page = 1, int $per_page = 10, array $filter = [], string $sort = null)
    {
        return $this->productRepository->query(
            $this->productFilterSpecification->specify($page, $per_page, $filter, $sort)
        );
    }

    public function find(string $id)
    {
        return $this->productRepository->find($id);
    }

}
