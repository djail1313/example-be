<?php


namespace Islami\Products\Domain\Model;


use Islami\Shared\Domain\ValueObject\StringValueObject;

class Name extends StringValueObject
{

    public function __construct(string $value)
    {
        $this->assertNotEmptyValue($value);
        parent::__construct($value);
    }

    protected function assertNotEmptyValue(string $value)
    {
        if (empty($value))
            throw new EmptyProductNameException();
    }

}
