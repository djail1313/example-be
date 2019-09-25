<?php


namespace Islami\Shared\Infrastructure\Persistence\Moloquent\Product;


class MoloquentProduct extends \Moloquent
{

    protected $connection = "mongodb";
    protected $collection = "products";

}
