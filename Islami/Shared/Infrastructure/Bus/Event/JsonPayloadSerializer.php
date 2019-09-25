<?php


namespace Islami\Shared\Infrastructure\Bus\Event;


use Islami\Shared\Bus\Event\PayloadSerializer;

class JsonPayloadSerializer implements PayloadSerializer
{

    public function serialize(array $data): string
    {
        return json_encode($data);
    }

    public function deserialize(string $data): array
    {
        return json_decode($data);
    }
}
