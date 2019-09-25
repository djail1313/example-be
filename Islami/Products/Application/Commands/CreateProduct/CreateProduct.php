<?php


namespace Islami\Products\Domain\Service\CreateProduct;


use Illuminate\Foundation\Bus\Dispatchable;
use Islami\Products\Application\Commands\CreateProduct\CreateProductService;
use Islami\Shared\Bus\Command\Command;

class CreateProduct extends Command
{

    use Dispatchable;

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
     * @var int
     */
    private $stock;
    /**
     * @var string
     */
    private $currency;

    public function __construct(
        string $name,
        ?string $description,
        float $price,
        string $currency,
        int $stock
    )
    {
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->stock = $stock;
        $this->currency = $currency;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescription():? string
    {
        return $this->description;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @return int
     */
    public function getStock(): int
    {
        return $this->stock;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function handle(CreateProductService $service)
    {
        return $service->handle($this);
    }
}
