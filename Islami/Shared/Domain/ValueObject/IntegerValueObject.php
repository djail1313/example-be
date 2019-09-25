<?php


namespace Islami\Shared\Domain\ValueObject;


class IntegerValueObject implements ValueObject
{

    private $value;

    /**
     * IntegerValueObject constructor.
     * @param $value
     */
    public function __construct(int $value)
    {
        $this->value = $value;
    }

    /**
     * @return int
     */
    public function getValue(): int
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
