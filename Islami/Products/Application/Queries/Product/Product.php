<?php


namespace Islami\Products\Application\Queries\Product;


use Carbon\Carbon;
use Islami\Shared\Application\Response;

class Product implements Response
{

    /**
     * @var string
     */
    private $id;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $description;
    /**
     * @var float
     */
    private $price;
    /**
     * @var string
     */
    private $currency;
    /**
     * @var int
     */
    private $stock;
    /**
     * @var Carbon
     */
    private $published_at;

    public function __construct(
        string $id,
        string $name,
        ? string $description,
        float $price,
        string $currency,
        int $stock,
        ? Carbon $published_at
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->currency = $currency;
        $this->stock = $stock;
        $this->published_at = $published_at;
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'currency' => $this->currency,
            'stock' => $this->stock,
            'published_at' => $this->published_at !== null ? $this->published_at->toAtomString() : null
        ];
    }
}
