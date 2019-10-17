<?php


namespace Islami\Shared\Infrastructure\Persistence\Repository\Specification;


use Carbon\Carbon;
use Islami\Shared\Exceptions\InvalidFieldException;

abstract class FilterFieldConverter
{

    public abstract function getAvailableFilter(): array;

    /**
     * @param string $field
     * @param mixed $value
     * @return Carbon|mixed
     * @throws InvalidFieldException
     */
    public function convert(string $field, $value)
    {
        $filter = $this->getAvailableFilter();

        if (! isset($filter[$field]))
            throw new InvalidFieldException($field);

        $type = $filter[$field];
        switch ($type) {
            case 'date':
                return $this->convertToDate($value);
            default:
                settype($value, $type);
                return $value;
        }
    }

    protected function convertToDate($value): Carbon
    {
        if ($value instanceof Carbon)
            return $value;
        return Carbon::createFromFormat(
            $this->dateFormat(),
            $value
        );
    }

    protected function dateFormat(): string
    {
        return 'Y-m-d H:i:s';
    }

}
