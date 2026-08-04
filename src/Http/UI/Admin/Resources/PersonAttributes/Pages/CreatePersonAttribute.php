<?php

declare(strict_types=1);

namespace Rimba\Attributing\Http\UI\Admin\Resources\PersonAttributes\Pages;

use Filament\Resources\Pages\CreateRecord;
use Rimba\Attributing\Http\UI\Admin\Resources\PersonAttributes\PersonAttributeResource;

class CreatePersonAttribute extends CreateRecord
{
    protected static string $resource = PersonAttributeResource::class;

    // Custom

}
