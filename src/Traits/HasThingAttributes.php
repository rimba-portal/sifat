<?php

declare(strict_types=1);

namespace Rimba\Attributing\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Rimba\Attributing\Models\ThingAttribute;

trait HasThingAttributes
{
    public function thingAttributes(): MorphMany
    {
        return $this->morphMany(
            ThingAttribute::class,
            'attributable',
        );
    }
}
