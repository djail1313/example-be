<?php


namespace Islami\Shared\Domain\ValueObject;


class StringValueObject implements ValueObject
{

    private $value;

    /**
     * StringValueObject constructor.
     * @param $value
     */
    public function __construct(?string $value)
    {
        $this->value = $value;
    }

    public function getValue():? string
    {
        return $this->value;
    }

    public function equalsTo($object): bool
    {
        return $this->getValue() === $object->getValue();
    }

    public static function createFrom($object)
    {
        return new self($object->getValue());
    }
}
