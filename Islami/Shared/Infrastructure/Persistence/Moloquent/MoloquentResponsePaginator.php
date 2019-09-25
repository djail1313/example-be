<?php

namespace Islami\Shared\Infrastructure\Persistence\Moloquent;

/**
 * Created by PhpStorm.
 * User: bahaso
 * Date: 10/09/19
 * Time: 14:15
 */

use ArrayAccess;
use Countable;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Pagination\Paginator;
use Islami\Shared\Application\Queries\ResponsePaginator;
use Islami\Shared\Application\Queries\ResponseCollectionTransformer;
use IteratorAggregate;
use Illuminate\Contracts\Pagination\Paginator as PaginatorContract;

class MoloquentResponsePaginator extends Paginator implements ResponsePaginator, Arrayable, ArrayAccess, Countable, IteratorAggregate, Jsonable, PaginatorContract
{
    protected $total_count;
    protected $page_count;

    public function __construct(
        $query,
        $currentPage = null,
        $perPage,
        ResponseCollectionTransformer $responseTransformer = null,
        array $options = [])
    {
        $this->perPage = $perPage;
        $this->currentPage = $currentPage;
        $this->total_count = $this->countData($query);
        $this->page_count = $this->countPage();
        $items = $this->paginate($query, $currentPage, $perPage);

        if ($responseTransformer) {
            $items = $responseTransformer->handle($items);
        }

        $this->items = $items;

        parent::__construct($this->items, $perPage, $currentPage, $options);
    }

    protected function paginate($items, $page, $per_page)
    {
        if ($page) {
            $skip = $per_page * ($page - 1);
            $items = $items->skip($skip);
        }

        if ($per_page) {
            $items = $items->limit($per_page);
        }


        return $items->get();
    }

    protected function countData($query)
    {
        return $query->count();
    }

    protected function countPage()
    {
        if ($this->perPage)
            return (int)ceil($this->total_count / $this->perPage);
        else
            return 1;
    }

    protected function checkForMorePages()
    {
        $this->hasMore = count($this->items) > ($this->perPage);
    }

    public function toArray()
    {
        return ['total_count' => $this->total_count, 'page_count' => $this->page_count,
            'current_page' => $this->currentPage, 'per_page' => $this->perPage,
            'data' => $this->items];
    }
}