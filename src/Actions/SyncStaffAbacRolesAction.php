<?php

declare(strict_types=1);

namespace Rimba\Attributing\Actions;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Rimba\Attributing\Services\PersonAttributeDefinitionResolver;
use Rimba\Attributing\Support\AttributeRoleName;
use Rimba\People\Models\Staff;
use Spatie\Permission\Models\Role;

final readonly class SyncStaffAbacRolesAction
{
    public function __construct(
        private PersonAttributeDefinitionResolver $personAttributeDefinitionResolver,
    ) {}

    public function execute(Staff $staff): void
    {
        $generatedRoles = $this->resolveGeneratedRoles($staff)
            ->unique()
            ->values();

        foreach ($generatedRoles as $roleName) {
            Role::findOrCreate($roleName, 'web');
        }

        $manualRoles = $staff->roles()
            ->pluck('name')
            ->reject(
                fn (string $roleName): bool => AttributeRoleName::isGenerated($roleName),
            )
            ->values();

        $staff->syncRoles([
            ...$manualRoles->all(),
            ...$generatedRoles->all(),
        ]);
    }

    private function resolveGeneratedRoles(Staff $staff): Collection
    {
        $roles = collect();

        if ($staff->user) {
            $roles = $roles->concat(
                $this->rolesFor($staff->user),
            );
        }

        $roles = $roles->concat(
            $this->rolesFor($staff),
        );

        if ($staff->jobPosition) {
            return $roles->concat(
                $this->rolesFor($staff->jobPosition),
            );
        }

        return $roles;
    }

    private function rolesFor(Model $model): Collection
    {
        if (! method_exists($model, 'personAttributes')) {
            return collect();
        }

        return $model->personAttributes()
            ->get()
            ->filter(
                fn ($attribute): bool => filled($attribute->key)
                    && filled($attribute->value)
                    && (bool) $this->personAttributeDefinitionResolver
                        ->resolve((string) $attribute->key)
                        ?->is_abac,
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
