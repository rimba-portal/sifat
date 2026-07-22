<?php

declare(strict_types=1);

namespace Rimba\Attributing\Support;

use Rimba\Attributing\Http\UI\RelationManagers\LocationAttributesRelationManager;
use Rimba\Attributing\Http\UI\RelationManagers\PersonAttributesRelationManager;
use Rimba\Attributing\Http\UI\RelationManagers\ThingAttributesRelationManager;
use Rimba\Attributing\Traits\HasLocationAttributes;
use Rimba\Attributing\Traits\HasPersonAttributes;
use Rimba\Attributing\Traits\HasThingAttributes;

final class HasAttributeRelationManagers
{
    /**
     * @return array<class-string>
     */
    public static function forModel(string $modelClass): array
    {
        $traits = class_uses_recursive($modelClass);

        $relations = [];

        if (in_array(HasPersonAttributes::class, $traits, true)) {
            $relations[] = PersonAttributesRelationManager::class;
        }

        if (in_array(HasThingAttributes::class, $traits, true)) {
            $relations[] = ThingAttributesRelationManager::class;
        }

        if (in_array(HasLocationAttributes::class, $traits, true)) {
            $relations[] = LocationAttributesRelationManager::class;
        }

        return $relations;
    }
}
