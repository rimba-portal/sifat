<?php

declare(strict_types=1);

namespace Rimba\Attributing\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Rimba\Attributing\Models\AttributeDefinition;
use Rimba\Attributing\Models\PersonAttribute;

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
                [
                    'key' => $key,
                ],
                [
                    'value' => $value,
                ],
            );
        }

        if ($extras !== []) {

            $this->attributes = array_merge(
                $this->attributes ?? [],
                $extras
            );

            $this->save();
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
