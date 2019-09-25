<?php


namespace Islami\Shared\Exceptions;

use Islami\Shared\HttpCode;

class InvalidImageExtension extends DomainException
{

    public function __construct($path)
    {
        $message = "Invalid image extension of file $path";
        parent::__construct(HttpCode::HTTP_UNPROCESSABLE_ENTITY, $message);
    }

}
