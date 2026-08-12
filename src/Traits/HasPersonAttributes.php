<?php

declare(strict_types=1);

namespace Rimba\Attributing\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Rimba\Attributing\Models\AttributeDefinition;
use Rimba\Attributing\Models\PersonAttribute;
use Spatie\Permission\Models\Role;

trait HasPersonAttributes
{
    public function personAttributes(): MorphMany
    {
        return $this->morphMany(PersonAttribute::class, 'attributable');
    }

    public static function seedMappings(): array
    {
        return [
            'attributes' => 'syncPersonAttributes',
        ];
    }

    public function syncPersonAttributes(array $attributes): void
    {
        $definitions = AttributeDefinition::query()
            ->where('family', 'person')
            ->get()
            ->keyBy('key');
        $extras = [];
        $abacRoles = [];
        foreach ($attributes as $key => $value) {
            if ($value === null || $value === '') {
                continue;
            }

            $value = $this->normalizePersonAttributeValue($value);
            $definition = $definitions[$key] ?? null;
            if (! $definition) {
                $extras[$key] = $value;

                continue;
            }

            $this->personAttributes()->updateOrCreate(
                ['key' => $key],
                ['value' => $value],
            );

            if ($definition->is_abac) {
                $role = sprintf('%s.%s', $key, $value);
                Role::findOrCreate($role, 'web');
                $abacRoles[] = $role;
            }
        }

        if ($extras !== []) {
            $this->attributes = array_merge(
                $this->attributes ?? [],
                $extras
            );
            $this->save();
        }

        if ($abacRoles !== [] && method_exists($this, 'syncRoles')) {

            $manualRoles = $this->roles
                ->pluck('name')
                ->reject(function ($roleName) use ($definitions): bool {
                    foreach ($definitions as $definition) {
                        if ($definition->is_abac && str_starts_with($roleName, $definition->key.'.')) {
                            return true;
                        }
                    }

                    return false;
                })
                ->values()
                ->all();
            $this->syncRoles([
                ...$manualRoles,
                ...array_unique($abacRoles),
            ]);
        }
    }

    protected function normalizePersonAttributeValue(mixed $value): ?string
    {
        if ($value === null) {
            return null;
        }

        if (is_bool($value)) {
            return $value ? '1' : '0';
        }

        if (is_scalar($value)) {
            return (string) $value;
        }

        return json_encode(
            $value,
            JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
        );
    }
}
