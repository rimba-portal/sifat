<?php

declare(strict_types=1);

namespace Rimba\Attributing\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Rimba\Attributing\Models\PersonAttribute;

trait HasPersonAttributes
{
    /**
     * @property Collection $personAttributes
     *
     * @method \Illuminate\Database\Eloquent\Relations\MorphMany personAttributes()
     */
    public function personAttributes(): MorphMany
    {
        return $this->morphMany(PersonAttribute::class, 'attributable');
    }

    public static function seedMappings(): array
    {
        return [
            'attributes' => [
                'type' => 'person_attributes',
                'relation' => 'personAttributes',
                'key_column' => 'key',
                'value_column' => 'value',
                'mode' => 'updateOrCreate',
            ],
        ];
    }

    public function syncPersonAttributes(array $attributes): void
    {
        foreach ($attributes as $key => $value) {
            if ($value === null) {
                continue;
            }

            $this->personAttributes()->updateOrCreate(
                ['key' => (string) $key],
                ['value' => is_scalar($value) ? (string) $value : json_encode($value)],
            );
        }
    }
}
