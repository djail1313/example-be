<?php
/**
 * Created by PhpStorm.
 * User: bahaso
 * Date: 10/09/19
 * Time: 14:33
 */

namespace Islami\Shared\Application\Queries;


use Illuminate\Support\Collection;

interface ResponseCollectionTransformer
{

    public function handle(Collection $items): Collection;

}