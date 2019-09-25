<?php


namespace Islami\Products\Domain\Model;

use Islami\Shared\Exceptions\DomainException;
use Islami\Shared\HttpCode;

class InsufficientStockException extends DomainException
{

    public function __construct()
    {
        parent::__construct(
            HttpCode::HTTP_UNPROCESSABLE_ENTITY,
            \Lang::get('products::product.stock_insufficient')
        );
    }

}
