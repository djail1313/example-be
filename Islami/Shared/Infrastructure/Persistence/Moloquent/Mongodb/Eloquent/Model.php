<?php


namespace Islami\Shared\Infrastructure\Persistence\Moloquent\Mongodb\Eloquent;

use Islami\Shared\Infrastructure\Persistence\Moloquent\Mongodb\Query\Builder;
use Jenssegers\Mongodb\Eloquent\Model as BaseModel;

class Model extends BaseModel
{

    protected function newBaseQueryBuilder()
    {
        $connection = $this->getConnection();

        return new Builder($connection, $connection->getPostProcessor());
    }

}
