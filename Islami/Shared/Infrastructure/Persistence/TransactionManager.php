<?php


namespace Islami\Shared\Infrastructure\Persistence;


interface TransactionManager
{

    public function begin(): void;
    public function commit(): void;
    public function rollBack(): void;
    public function transaction(\Closure $callback);
    public function transactionLevel(): int;

}
