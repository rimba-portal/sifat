<?php

declare(strict_types=1);

namespace Rimba\Attributing\Http\UI\Admin\Resources\LocationAttributes\Pages;

use Rimba\Attributing\Http\UI\Admin\Resources\LocationAttributes\LocationAttributeResource;
use Filament\Resources\Pages\CreateRecord;

class CreateLocationAttribute extends CreateRecord
{
    protected static string $resource = LocationAttributeResource::class;
}
