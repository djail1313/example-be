<?php


namespace Islami\Products\Domain\Model;


use Islami\Products\Shared\Domain\Model\Product\ProductId;
use Islami\Shared\Domain\Aggregate\AggregateRoot;

class Product extends AggregateRoot
{

    /**
     * @var ProductId
     */
    private $id;
    /**
     * @var Name
     */
    private $name;
    /**
     * @var Description
     */
    private $description;
    /**
     * @var Price
     */
    private $price;
    /**
     * @var Stock
     */
    private $stock;

    public function __construct(
        ProductId $id,
        Name $name,
        Description $description,
        Price $price,
        Stock $stock
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->stock = $stock;
    }

    /**
     * @return ProductId
     */
    public function getId(): ProductId
    {
        return $this->id;
    }

    /**
     * @return Name
     */
    public function getName(): Name
    {
        return $this->name;
    }

    /**
     * @return Description
     */
    public function getDescription(): Description
    {
        return $this->description;
    }

    /**
     * @return Price
     */
    public function getPrice(): Price
    {
        return $this->price;
    }

    /**
     * @return Stock
     */
    public function getStock(): Stock
    {
        return $this->stock;
    }

    public function reduceStock(int $value)
    {
        $this->stock = $this->stock->reduce($value);
    }

}
