<?php

declare(strict_types=1);

namespace Rimba\Attributing\Traits;

use Rimba\Attributing\Models\PersonAttribute;
use Illuminate\Database\Eloquent\Relations\MorphMany;

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
}
