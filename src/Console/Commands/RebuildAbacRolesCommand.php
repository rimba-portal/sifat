<?php

declare(strict_types=1);

namespace Rimba\Attributing\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Rimba\Attributing\Actions\EnsureAbacRoleExistsAction;
use Rimba\Attributing\Actions\SyncStaffAbacRolesAction;
use Rimba\Attributing\Models\PersonAttribute;
use Rimba\People\Models\Staff;

#[Description('Rebuild generated ABAC roles from person attributes')]
#[Signature('rimba:rebuild-abac-roles')]
final class RebuildAbacRolesCommand extends Command
{
    public function handle(
        EnsureAbacRoleExistsAction $ensureRoles,
        SyncStaffAbacRolesAction $syncStaffRoles,
    ): int {
        PersonAttribute::query()
            ->with('attributable')
            ->each(
                fn (PersonAttribute $attribute): ?\Spatie\Permission\Models\Role => $ensureRoles->execute($attribute),
            );

        Staff::query()
            ->with([
                'user',
                'personAttributes',
                'jobPosition.personAttributes',
            ])
            ->each(
                fn (Staff $staff) => $syncStaffRoles->execute($staff),
            );

        $this->components->info(
            'ABAC roles rebuilt successfully.'
        );

        return self::SUCCESS;
    }
}
