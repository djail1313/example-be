<?php


namespace Islami\Products\Application\Commands\ReduceProductStock;


use Illuminate\Foundation\Bus\Dispatchable;
use Islami\Shared\Bus\Command\Command;

class ReduceProductStock extends Command
{

    use Dispatchable;

    /**
     * @var string
     */
    private $id;
    /**
     * @var int
     */
    private $stock;

    public function __construct(string $id, int $stock)
    {
        $this->id = $id;
        $this->stock = $stock;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getStock(): int
    {
        return $this->stock;
    }

    public function handle(ReduceProductStockService $reduceProductStockService)
    {
        $reduceProductStockService->handle($this);
    }

}
