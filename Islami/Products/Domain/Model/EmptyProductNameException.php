<?php


namespace Islami\Products\Domain\Model;

use Islami\Shared\Exceptions\DomainException;
use Islami\Shared\HttpCode;

class EmptyProductNameException extends DomainException
{

    public function __construct()
    {
        parent::__construct(
            HttpCode::HTTP_UNPROCESSABLE_ENTITY,
            \Lang::get('products::product.name_empty')
        );
    }

}
