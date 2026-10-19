<?php

declare(strict_types=1);

namespace Rimba\Attributing\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Rimba\Attributing\Models\AttributeDefinition;
use Rimba\Attributing\Models\PersonAttribute;
use Rimba\Attributing\Support\AttributeSubject;

trait HasPersonAttributes
{
    public function personAttributes(): MorphMany
    {
        return $this->morphMany(
            PersonAttribute::class,
            'attributable',
        );
    }

    public function syncPersonAttributes(array $attributes): void
    {
        $subject = AttributeSubject::for($this);

        $definitions = AttributeDefinition::query()
            ->where('family', 'person')
            ->where('is_active', true)
            ->get()
            ->keyBy('key');

        foreach ($attributes as $key => $value) {
            if ($value === null || $value === '') {
                continue;
            }

            $definition = $definitions->get($key);

            if (! $definition) {
                continue;
            }

            // Definition must apply to this model.
            if (! in_array(
                $subject,
                $definition->applies_to ?? [],
                true,
            )) {
                continue;
            }

            $this->personAttributes()->updateOrCreate(
                ['key' => $key],
                [
                    'value' => $this->normalizePersonAttributeValue($value),
                    'is_abac' => (bool) $definition->is_abac,
                ],
            );
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
            JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES,
        ) ?: null;
    }
}
