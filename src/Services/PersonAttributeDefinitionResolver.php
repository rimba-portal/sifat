<?php

declare(strict_types=1);

namespace Rimba\Attributing\Services;

use Rimba\Attributing\Models\AttributeDefinition;

final class PersonAttributeDefinitionResolver
{
    public function resolve(string $key): ?AttributeDefinition
    {
        return AttributeDefinition::query()
            ->where('family', 'person')
            ->where('key', $key)
            ->where('is_active', true)
            ->first();
    }
}
