<?php

declare(strict_types=1);

namespace Rimba\Attributing\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Rimba\Attributing\Observers\PersonAttributeObserver;

#[ObservedBy(PersonAttributeObserver::class)]
#[Fillable([
    'key',
    'value',
    'is_abac',
    'attributable_id',
    'attributable_type',
])]
class PersonAttribute extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'is_abac' => 'boolean',
        ];
    }

    public function attributable(): MorphTo
    {
        return $this->morphTo();
    }
}
