<?php


namespace Islami\Shared\Bus\Event;


interface PayloadSerializer
{
    public function serialize(array $data): string;
    public function deserialize(string $data): array;
}
