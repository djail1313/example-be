<?php


namespace Islami\Shared\Domain\ValueObject;

use MongoDB\BSON\ObjectId;

class Id implements ValueObject
{

    private $id;

    public function __construct(string $id = null)
    {
        if (!$id)
            $id = new ObjectId();
        $this->id = $id;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function equalsTo($object): bool
    {
        return $this->getId() === $object->getId();
    }

    public static function createFrom($object): Id
    {
        return new self($object->getId());
    }
}
