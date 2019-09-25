<?php


namespace Islami\Shared\Infrastructure\Persistence\Moloquent;

use Islami\Shared\Infrastructure\Persistence\TransactionManager;

class MoloquentTransactionManager implements TransactionManager
{

    public function begin(): void
    {
        \DB::beginTransaction();
    }

    public function commit(): void
    {
       \DB::commit();
    }

    public function rollBack(): void
    {
        \DB::rollBack();
    }

    public function transaction(\Closure $callback)
    {
        \DB::transaction($callback);
    }

    public function transactionLevel(): int
    {
        return \DB::transactionLevel();
    }


}
