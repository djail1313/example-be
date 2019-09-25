<?php


namespace Islami\Products\Domain\Model;


use Islami\Shared\Domain\ValueObject\ValueObject;

class Price implements ValueObject
{

    /**
     * @var float
     */
    private $price;
    /**
     * @var Currency
     */
    private $currency;

    public function __construct(float $price, Currency $currency)
    {
        $this->assertNotFree($price);
        $this->price = $price;
        $this->currency = $currency;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @return Currency
     */
    public function getCurrency(): Currency
    {
        return $this->currency;
    }

    protected function assertNotFree(float $price)
    {
        if ($price <= 0)
            throw new InvalidProductPriceException();
    }

    /**
     * @var Price $object
     * @return bool
     */
    public function equalsTo($object): bool
    {
        if ($object instanceof Price)
            return false;

        return (
            $this->getCurrency()->equalsTo($object->getCurrency()) &&
            $this->getPrice() === $object->getPrice()
        );
    }

    /**
     * @var Price $object
     * @return Price
     */
    public static function createFrom($object)
    {
        return new Price(
            $object->getPrice(),
            Currency::createFrom($object->getCurrency()->getValue())
        );
    }
}
