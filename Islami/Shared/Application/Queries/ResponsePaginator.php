<?php

namespace Islami\Shared\Application\Queries;

/**
 * Created by PhpStorm.
 * User: bahaso
 * Date: 10/09/19
 * Time: 14:23
 */
interface ResponsePaginator
{

    public function toArray();
    public function jsonSerialize();
    public function toJson($options = 0);
    public function hasMorePages();
    public function nextPageUrl();

}