<?php


namespace Islami\Shared\Domain\ValueObject;


interface ValueObject
{

    public function equalsTo($object) : bool;
    public static function createFrom($object);

}
