<?php

declare(strict_types=1);

namespace Rimba\Attributing\Actions;

use Illuminate\Support\Str;
use Rimba\Attributing\Models\AttributeDefinition;
use Rimba\People\Models\Staff;
use Rimba\Position\Models\JobPosition;
use Spatie\Permission\Models\Role;

class SyncAssignableAbacRolesAction
{
    public function execute(object $model): void
    {
        $assignable = $this->resolveAssignable($model);

        if (! $assignable) {
            return;
        }

        $definitions = AttributeDefinition::query()
            ->where('family', 'person')
            ->where('is_abac', true)
            ->get()
            ->keyBy('key');

        $abacRoles = $model->personAttributes
            ->filter(fn ($attribute): bool => isset($definitions[$attribute->key]))
            ->map(function ($attribute) use ($model): string {
                return sprintf(
                    '%s§%s§%s',
                    Str::snake(class_basename($model)),
                    $attribute->key,
                    $attribute->value,
                );
            })
            ->unique()
            ->values()
            ->all();

        foreach ($abacRoles as $role) {
            Role::findOrCreate($role, 'web');
        }

        $manualRoles = $assignable->roles
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

    protected function resolveAssignable(object $model): ?object
    {
        if (method_exists($model, 'syncRoles')) {
            return $model;
        }

        if ($model instanceof JobPosition) {
            return Staff::query()
                ->whereHas(
                    'jobPosition',
                    fn ($q) => $q->whereKey($model->getKey())
                )
                ->first();
        }

        return null;
    }
}
