<?php
/**
 * Created by PhpStorm.
 * User: bahaso
 * Date: 12/09/19
 * Time: 14:35
 */

namespace Islami\Shared\Domain\ValueObject;


use Illuminate\Http\UploadedFile;

class FileValueObject implements ValueObject
{
    /**
     * @var UploadedFile
     */
    private $file;

    /**
     * FileValueObject constructor.
     * @param UploadedFile $file
     */
    function __construct(UploadedFile $file)
    {
        $this->file = $file;
    }

    public function equalsTo($object): bool
    {
        return $this->file === $object;
    }

    public static function createFrom($object)
    {
        // TODO: Implement createFrom() method.
    }
}