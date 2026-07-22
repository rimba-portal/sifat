<?php

declare(strict_types=1);

namespace Rimba\Attributing\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Rimba\Attributing\Models\LocationAttribute;

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
