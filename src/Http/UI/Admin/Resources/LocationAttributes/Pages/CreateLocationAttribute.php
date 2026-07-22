<?php

declare(strict_types=1);

namespace Rimba\Attributing\Http\UI\Admin\Resources\LocationAttributes\Pages;

use Filament\Resources\Pages\CreateRecord;
use Rimba\Attributing\Http\UI\Admin\Resources\LocationAttributes\LocationAttributeResource;

class CreateLocationAttribute extends CreateRecord
{
    protected static string $resource = LocationAttributeResource::class;
}
