<?php

declare(strict_types=1);

namespace Rimba\Attributing\Actions;

use Illuminate\Support\Str;
use Rimba\Attributing\Models\PersonAttribute;
use Spatie\Permission\Models\Role;

class EnsureAbacRoleExistsAction
{
    public function execute(PersonAttribute $attribute): void
    {
        $definition = $attribute->definition;

        if (! $definition?->is_abac) {
            return;
        }

        $role = sprintf(
            '%s§%s§%s',
            Str::snake(class_basename($attribute->attributable)),
            $attribute->key,
            $attribute->value,
        );

        Role::findOrCreate($role, 'web');
    }
}
