<?php

declare(strict_types=1);

namespace Rimba\Attributing\Traits;

trait SeedsPersonAttributes
{
    public function afterJsonSeed(array $payload): void
    {
        $attributes = $payload['attributes'] ?? null;

        if (! is_array($attributes)) {
            return;
        }

        $this->syncPersonAttributes($attributes);
    }
}
