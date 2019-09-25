<?php


namespace Islami\Products\Shared\Exceptions;


use Islami\Shared\Exceptions\DomainException;
use Islami\Shared\HttpCode;

class ProductNotFoundException extends DomainException
{

    public function __construct()
    {
        parent::__construct(
            HttpCode::HTTP_NOT_FOUND,
            \Lang::get('products::product.not_found')
        );
    }

}
