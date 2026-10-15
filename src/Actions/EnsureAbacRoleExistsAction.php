<?php

declare(strict_types=1);

namespace Rimba\Attributing\Actions;

use Illuminate\Database\Eloquent\Model;
use Rimba\Attributing\Support\AttributeRoleName;
use Spatie\Permission\Models\Role;

final class EnsureAbacRoleExistsAction
{
    public function execute(Model $attribute): void
    {
        $attributable = $attribute->attributable;

        if (! $attributable || ! $attribute->is_abac) {
            return;
        }

        if (blank($attribute->key) || blank($attribute->value)) {
            return;
        }

        Role::findOrCreate(
            AttributeRoleName::make(
                model: $attributable,
                key: (string) $attribute->key,
                value: (string) $attribute->value,
            ),
            'web',
        );
    }
}
