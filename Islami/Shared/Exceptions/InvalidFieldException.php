<?php


namespace Islami\Shared\Exceptions;

use Islami\Shared\HttpCode;

class InvalidFieldException extends DomainException
{

    public function __construct(string $field)
    {
        $message = \Lang::get('shared::specification.field.not_allowed', ['field' => $field]);
        parent::__construct(HttpCode::HTTP_UNPROCESSABLE_ENTITY, $message);
    }

}
