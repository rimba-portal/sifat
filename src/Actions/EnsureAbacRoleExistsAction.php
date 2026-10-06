<?php

declare(strict_types=1);

namespace Rimba\Attributing\Actions;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class EnsureAbacRoleExistsAction
{
    public function execute(Model $attribute): void
    {
        $attributable = $attribute->attributable;

        if (! $attributable) {
            return;
        }

        $role = sprintf(
            '%s§%s§%s',
            Str::snake(class_basename($attributable)),
            $attribute->key,
            $attribute->value,
        );

        Role::findOrCreate($role, 'web');
    }
}
