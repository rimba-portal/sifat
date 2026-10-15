<?php

declare(strict_types=1);

namespace Rimba\Attributing\Actions;

use Illuminate\Support\Collection;
use Rimba\Attributing\Support\AttributeRoleName;
use Rimba\People\Models\Staff;
use Spatie\Permission\Models\Role;

final class SyncStaffAbacRolesAction
{
    public function execute(Staff $staff): void
    {
        $abacRoles = $this->resolveAbacRoles($staff)
            ->unique()
            ->values();

        foreach ($abacRoles as $role) {
            Role::findOrCreate($role, 'web');
        }

        $manualRoles = $staff->roles()
            ->pluck('name')
            ->reject(
                fn (string $role): bool => AttributeRoleName::isGenerated($role),
            )
            ->values();

        $staff->syncRoles([
            ...$manualRoles->all(),
            ...$abacRoles->all(),
        ]);
    }

    private function resolveAbacRoles(Staff $staff): Collection
    {
        $roles = collect();

        if ($staff->user) {
            $roles = $roles->concat(
                $this->attributesToRoles($staff->user),
            );
        }

        $roles = $roles->concat(
            $this->attributesToRoles($staff),
        );

        if ($staff->jobPosition) {
            return $roles->concat(
                $this->attributesToRoles($staff->jobPosition),
            );
        }

        return $roles;
    }

    private function attributesToRoles(object $model): Collection
    {
        if (! method_exists($model, 'personAttributes')) {
            return collect();
        }

        return $model->personAttributes()
            ->where('is_abac', true)
            ->get()
            ->filter(
                fn ($attribute): bool => filled($attribute->key)
                    && filled($attribute->value),
            )
            ->map(
                fn ($attribute): string => AttributeRoleName::make(
                    model: $model,
                    key: (string) $attribute->key,
                    value: (string) $attribute->value,
                ),
            );
    }
}
