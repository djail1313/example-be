<?php
/**
 * Created by PhpStorm.
 * User: bahaso
 * Date: 20/09/19
 * Time: 14:29
 */

namespace Islami\Shared\Domain\ValueObject;


use Carbon\Carbon;

abstract class DateValueObject implements ValueObject
{
    private $value;

    /**
     * DateValueObject constructor.
     * @param $value
     */
    public function __construct(String $value)
    {
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getValue() : Carbon
    {
        return Carbon::createFromFormat($this->getFormat(), $this->value);
    }

    public function equalsTo($object): bool
    {
        // TODO: Implement equalsTo() method.
    }

    public static function createFrom($object)
    {
        // TODO: Implement createFrom() method.
    }

    public abstract function getFormat() : String;
}