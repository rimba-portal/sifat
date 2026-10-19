<?php

declare(strict_types=1);

namespace Rimba\Attributing\Actions;

use Rimba\Attributing\Models\PersonAttribute;
use Rimba\Attributing\Services\PersonAttributeDefinitionResolver;
use Rimba\Attributing\Support\AttributeRoleName;
use Rimba\Attributing\Support\AttributeSubject;
use Spatie\Permission\Models\Role;

final readonly class EnsureAbacRoleExistsAction
{
    public function __construct(
        private PersonAttributeDefinitionResolver $personAttributeDefinitionResolver,
    ) {}

    public function execute(PersonAttribute $attribute): ?Role
    {
        $owner = $attribute->attributable;

        if (! $owner) {
            return null;
        }

        if (blank($attribute->key) || blank($attribute->value)) {
            return null;
        }

        $definition = $this->personAttributeDefinitionResolver->resolve(
            (string) $attribute->key,
        );

        if (! $definition?->is_abac) {
            return null;
        }

        if (! in_array(
            AttributeSubject::for($owner),
            $definition->applies_to ?? [],
            true,
        )) {
            return null;
        }

        return Role::findOrCreate(
            AttributeRoleName::make(
                model: $owner,
                key: (string) $attribute->key,
                value: (string) $attribute->value,
            ),
            'web',
        );
    }
}
