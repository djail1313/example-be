<?php


namespace Islami\Products\Domain\Service\CreateProduct;


use Carbon\Carbon;
use Illuminate\Foundation\Bus\Dispatchable;
use Islami\Products\Application\Commands\CreateProduct\CreateProductService;
use Islami\Shared\Bus\Command\Command;
use Islami\Shared\Bus\Command\Traits\UseTransaction;

class CreateProduct extends Command
{

    use Dispatchable, UseTransaction;

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
    /**
     * @var Carbon
     */
    private $published_at;

    public function __construct(
        string $name,
        ? string $description,
        float $price,
        string $currency,
        int $stock,
        Carbon $published_at
    )
    {
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->stock = $stock;
        $this->currency = $currency;
        $this->published_at = $published_at;
    }

    /**
     * @return Carbon
     */
    public function getPublishedAt(): Carbon
    {
        return $this->published_at;
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
