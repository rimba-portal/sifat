<?php

declare(strict_types=1);

namespace Rimba\Attributing\Traits;

use Rimba\Attributing\Models\LocationAttribute;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasLocationAttributes
{
    /**
     * @property Collection $LocationAttributes
     *
     * @method \Illuminate\Database\Eloquent\Relations\MorphMany LocationAttributes()
     */
    public function LocationAttributes(): MorphMany
    {
        return $this->morphMany(LocationAttribute::class, 'attributable');
    }
}
