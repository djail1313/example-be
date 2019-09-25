<?php


namespace Islami\Shared\Bus\Command\Traits;


trait UseTransaction
{

    public function useTransaction(): bool
    {
        return true;
    }

}
