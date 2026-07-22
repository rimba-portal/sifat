<?php

declare(strict_types=1);

namespace Rimba\Attributing\Http\UI\Admin\Resources\ThingAttributes\Pages;

use Filament\Resources\Pages\CreateRecord;
use Rimba\Attributing\Http\UI\Admin\Resources\ThingAttributes\ThingAttributeResource;

class CreateThingAttribute extends CreateRecord
{
    protected static string $resource = ThingAttributeResource::class;
}
