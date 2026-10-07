<?php

declare(strict_types=1);

namespace Rimba\Attributing\Actions;

use Illuminate\Support\Collection as SupportCollection;
use Illuminate\Support\Str;
use Rimba\People\Models\Staff;
use Rimba\Position\Models\JobPosition;
use Spatie\Permission\Models\Role;

class SyncAssignableAbacRolesAction
{
    public function execute(object $model): void
    {
        if (! method_exists($model, 'personAttributes')) {
            return;
        }

        $abacRoles = $model->personAttributes()
            ->where('is_abac', true)
            ->get()
            ->filter(
                fn ($attribute): bool => filled($attribute->key) &&
                    filled($attribute->value)
            )
            ->map(
                fn ($attribute): string => sprintf(
                    '%s§%s§%s',
                    Str::snake(class_basename($model)),
                    $attribute->key,
                    $attribute->value,
                )
            )
            ->unique()
            ->values()
            ->all();

        foreach ($abacRoles as $role) {
            Role::findOrCreate($role, 'web');
        }

        foreach ($this->resolveAssignables($model) as $assignable) {
            $manualRoles = $assignable->roles()
                ->pluck('name')
                ->reject(
                    fn (string $role): bool => str_contains($role, '§')
                )
                ->values()
                ->all();

            $assignable->syncRoles([
                ...$manualRoles,
                ...$abacRoles,
            ]);
        }
    }

    protected function resolveAssignables(object $model): SupportCollection
    {
        if ($model instanceof JobPosition) {
            return Staff::query()
                ->whereHas(
                    'jobPosition',
                    fn ($query) => $query->whereKey($model->getKey())
                )
                ->get()
                ->filter(
                    fn (Staff $staff): bool => method_exists($staff, 'syncRoles')
                );
        }

        if (method_exists($model, 'syncRoles')) {
            return collect([$model]);
        }

        return collect();
    }
}
