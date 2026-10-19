<?php

declare(strict_types=1);

namespace Rimba\Attributing\Observers;

use Rimba\Attributing\Actions\EnsureAbacRoleExistsAction;
use Rimba\Attributing\Actions\SyncStaffAbacRolesAction;
use Rimba\Attributing\Models\PersonAttribute;
use Rimba\Attributing\Services\PersonAttributeDefinitionResolver;
use Rimba\People\Models\Staff;
use Rimba\Position\Models\JobPosition;

final readonly class PersonAttributeObserver
{
    public function __construct(
        private PersonAttributeDefinitionResolver $personAttributeDefinitionResolver,
        private EnsureAbacRoleExistsAction $ensureAbacRoleExistsAction,
        private SyncStaffAbacRolesAction $syncStaffAbacRolesAction,
    ) {}

    public function created(PersonAttribute $attribute): void
    {
        $this->handle($attribute);
    }

    public function updated(PersonAttribute $attribute): void
    {
        $this->handle($attribute);
    }

    public function deleted(PersonAttribute $attribute): void
    {
        $this->syncAffectedStaff($attribute);
    }

    private function handle(PersonAttribute $attribute): void
    {
        $definition = $this->personAttributeDefinitionResolver->resolve(
            (string) $attribute->key,
        );

        $isAbac = (bool) $definition?->is_abac;

        if ((bool) $attribute->is_abac !== $isAbac) {
            $attribute->forceFill([
                'is_abac' => $isAbac,
            ])->saveQuietly();
        }

        if (! $isAbac) {
            $this->syncAffectedStaff($attribute);

            return;
        }

        $this->ensureAbacRoleExistsAction->execute($attribute);
        $this->syncAffectedStaff($attribute);
    }

    private function syncAffectedStaff(PersonAttribute $attribute): void
    {
        $owner = $attribute->attributable;

        if ($owner instanceof Staff) {
            $this->syncStaffAbacRolesAction->execute($owner);

            return;
        }

        if ($owner instanceof JobPosition) {
            Staff::query()
                ->whereHas(
                    'jobPosition',
                    fn ($query) => $query->whereKey($owner->getKey()),
                )
                ->each(
                    fn (Staff $staff) => $this->syncStaffAbacRolesAction->execute($staff),
                );
        }
    }
}
