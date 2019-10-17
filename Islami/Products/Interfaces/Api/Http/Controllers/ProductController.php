<?php


namespace Islami\Products\Interfaces\Api\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Islami\Products\Application\Commands\ReduceProductStock\ReduceProductStock;
use Islami\Products\Application\Queries\Product\ProductService;
use Islami\Products\Domain\Service\CreateProduct\CreateProduct;

class ProductController extends Controller
{

    /**
     * @var ProductService
     */
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function create(Request $request)
    {
        CreateProduct::dispatchNow(
            $request->input('name'),
            $request->input('description'),
            $request->input('price'),
            $request->input('currency'),
            $request->input('stock')
        );

        return response()->api();
    }

    public function reduceStock(Request $request, $id)
    {
        ReduceProductStock::dispatchNow(
            $id,
            $request->input('stock')
        );

        return response()->api();
    }

    public function get(Request $request)
    {
        return response()->api(
            $this->productService->get(
                $request->query('page', 1),
                $request->query('per_page', 10),
                $request->query('filter', []),
                $request->query('sort')
            )
        );
    }

}
