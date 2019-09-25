<?php


namespace Islami\Shared\Bus\Command;


class Command
{

    public function useTransaction(): bool
    {
        return false;
    }

}
