<?php

declare(strict_types=1);

namespace Rimba\Attributing\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Rimba\Attributing\Models\LocationAttribute;

trait HasLocationAttributes
{
    public function locationAttributes(): MorphMany
    {
        return $this->morphMany(
            LocationAttribute::class,
            'attributable',
        );
    }
}
