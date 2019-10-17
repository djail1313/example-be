<?php


namespace Islami\Products\Infrastructure\Domain\Model\Product;


use Islami\Products\Domain\Model\Currency;
use Islami\Products\Domain\Model\Description;
use Islami\Products\Domain\Model\Name;
use Islami\Products\Domain\Model\Price;
use Islami\Products\Domain\Model\Product;
use Islami\Products\Domain\Model\ProductRepository;
use Islami\Products\Domain\Model\Stock;
use Islami\Products\Shared\Domain\Model\Product\ProductId;
use Islami\Shared\Infrastructure\Persistence\Moloquent\Product\MoloquentProduct;

class MoloquentProductRepository implements ProductRepository
{

    public function generateId(): ProductId
    {
        return new ProductId();
    }

    public function save(Product $product): bool
    {
        $moloquent_product = MoloquentProduct::find($product->getId()->getId());

        if (!$moloquent_product)
            $moloquent_product = new MoloquentProduct();

        $moloquent_product->_id = $product->getId()->getId();
        $moloquent_product->name = $product->getName()->getValue();
        $moloquent_product->description = $product->getDescription()->getValue();
        $moloquent_product->stock = $product->getStock()->getValue();
        $moloquent_product->price = $product->getPrice()->getPrice();
        $moloquent_product->currency = $product->getPrice()->getCurrency()->getValue();
        $moloquent_product->published_at = $product->getPublishedAt();

        return $moloquent_product->save();
    }

    public function find(ProductId $id): ?Product
    {
        $moloquent_product = MoloquentProduct::find($id->getId());

        if (! $moloquent_product)
            return null;

        return $this->mapMoloquentToModel($moloquent_product);
    }

    protected function mapMoloquentToModel(MoloquentProduct $moloquentProduct): Product
    {
        return new Product(
            new ProductId($moloquentProduct->_id),
            new Name($moloquentProduct->name),
            new Description($moloquentProduct->description),
            new Price(
                $moloquentProduct->price,
                new Currency($moloquentProduct->currency)
            ),
            new Stock($moloquentProduct->stock),
            $moloquentProduct->published_at
        );
    }
}
