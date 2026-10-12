<?php

declare(strict_types=1);

namespace Rimba\Attributing\Actions;

use Illuminate\Support\Collection as SupportCollection;
use Illuminate\Support\Str;
use Rimba\People\Models\Staff;
use Spatie\Permission\Models\Role;

class SyncStaffAbacRolesAction
{
    protected string $delimiter = '◇'; //  '◇' used for ABAC whereas '◆' used for RBAC

    public function execute(Staff $staff): void
    {
        $abacRoles = $this->resolveAbacRoles($staff)
            ->unique()
            ->values()
            ->all();

        foreach ($abacRoles as $role) {
            Role::findOrCreate($role, 'web');
        }

        $manualRoles = $staff->roles()
            ->pluck('name')
            ->reject(
                fn (string $role): bool => str_contains($role, $this->delimiter)
            )
            ->values()
            ->all();

        $staff->syncRoles([
            ...$manualRoles,
            ...$abacRoles,
        ]);
    }

    protected function resolveAbacRoles(Staff $staff): SupportCollection
    {
        $roles = collect();

        if ($staff->user) {
            $roles = $roles->concat(
                $this->attributesToRoles($staff->user)
            );
        }

        $roles = $roles->concat(
            $this->attributesToRoles($staff)
        );

        if ($staff->jobPosition) {
            return $roles->concat(
                $this->attributesToRoles($staff->jobPosition)
            );
        }

        return $roles;
    }

    protected function attributesToRoles(object $model): SupportCollection
    {
        if (! method_exists($model, 'personAttributes')) {
            return collect();
        }

        $prefix = Str::snake(class_basename($model));

        return $model->personAttributes()
            ->where('is_abac', true)
            ->get()
            ->filter(
                fn ($attribute): bool => filled($attribute->key) &&
                    filled($attribute->value)
            )
            ->map(
                fn ($attribute): string => implode(
                    $this->delimiter,
                    [
                        $prefix,
                        $attribute->key,
                        $attribute->value,
                    ]
                )
            );
    }
}
