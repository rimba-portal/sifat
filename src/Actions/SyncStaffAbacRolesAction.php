<?php

declare(strict_types=1);

namespace Rimba\Attributing\Actions;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Rimba\Attributing\Services\PersonAttributeDefinitionResolver;
use Rimba\Attributing\Support\AttributeRoleName;
use Rimba\Attributing\Support\AttributeSubject;
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

        /*
         * Preserve manually assigned roles.
         *
         * Only generated attribute roles are recalculated.
         */
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

        /*
         * User attributes.
         */
        if ($staff->user) {
            $roles = $roles->concat(
                $this->rolesFor($staff->user),
            );
        }

        /*
         * Staff attributes.
         */
        $roles = $roles->concat(
            $this->rolesFor($staff),
        );

        /*
         * JobPosition attributes.
         */
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

        $subject = AttributeSubject::for($model);

        return $model->personAttributes()
            ->get()
            ->filter(function ($attribute) use ($subject): bool {
                if (
                    blank($attribute->key)
                    || blank($attribute->value)
                ) {
                    return false;
                }

                $definition = $this
                    ->personAttributeDefinitionResolver
                    ->resolve((string) $attribute->key);

                if (! $definition?->is_abac) {
                    return false;
                }

                return in_array(
                    $subject,
                    $definition->applies_to ?? [],
                    true,
                );
            })
            ->map(
                fn ($attribute): string => AttributeRoleName::make(
                    model: $model,
                    key: (string) $attribute->key,
                    value: (string) $attribute->value,
                ),
            );
    }
}
