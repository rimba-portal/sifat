<?php

declare(strict_types=1);

namespace Rimba\Attributing\Observers;

use Rimba\Attributing\Actions\EnsureAbacRoleExistsAction;
use Rimba\Attributing\Models\PersonAttribute;

class PersonAttributeObserver
{
    public function created(PersonAttribute $attribute): void
    {
        if (! $attribute->is_abac) {
            return;
        }

        app(EnsureAbacRoleExistsAction::class)
            ->execute($attribute);
    }

    public function updated(PersonAttribute $attribute): void
    {
        if (! $attribute->is_abac) {
            return;
        }

        app(EnsureAbacRoleExistsAction::class)
            ->execute($attribute);
    }
}
