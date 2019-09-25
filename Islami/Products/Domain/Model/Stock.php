<?php


namespace Islami\Products\Domain\Model;


use Islami\Shared\Domain\ValueObject\IntegerValueObject;

class Stock extends IntegerValueObject
{

    public function __construct(int $value)
    {
        $this->assertMustUnsignedInteger($value);
        parent::__construct($value);
    }

    public function reduce(int $value)
    {
        $reduced_value = $this->getValue() - $value;

        if ($reduced_value < 0)
            throw new InsufficientStockException();

        return new Stock($reduced_value);
    }

    protected function assertMustUnsignedInteger(int $value)
    {
        if ($value < 0)
            throw new InvalidValueProductStockException();
    }

}
