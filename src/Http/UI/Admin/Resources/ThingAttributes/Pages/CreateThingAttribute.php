<?php

declare(strict_types=1);

namespace Rimba\Attributing\Http\UI\Admin\Resources\ThingAttributes\Pages;

use Rimba\Attributing\Http\UI\Admin\Resources\ThingAttributes\ThingAttributeResource;
use Filament\Resources\Pages\CreateRecord;

class CreateThingAttribute extends CreateRecord
{
    protected static string $resource = ThingAttributeResource::class;
}
