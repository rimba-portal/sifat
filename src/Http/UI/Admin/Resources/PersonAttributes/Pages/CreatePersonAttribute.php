<?php

declare(strict_types=1);

namespace Rimba\Attributing\Http\UI\Admin\Resources\PersonAttributes\Pages;

use Rimba\Attributing\Http\UI\Admin\Resources\PersonAttributes\PersonAttributeResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePersonAttribute extends CreateRecord
{
    protected static string $resource = PersonAttributeResource::class;
}
