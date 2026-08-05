<?php

declare(strict_types=1);

namespace Rimba\Attributing\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;
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
            'abac' => 'syncPersonAttributes',
        ];
    }

    public function syncPersonAttributes(array $attributes): void
    {
        foreach ($attributes as $key => $value) {
            if ($value === null || $value === '') {
                continue;
            }

            $this->personAttributes()->updateOrCreate(
                [
                    'key' => (string) $key,
                ],
                [
                    'value' => $this->normalizePersonAttributeValue($value),
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

        return json_encode($value, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}
