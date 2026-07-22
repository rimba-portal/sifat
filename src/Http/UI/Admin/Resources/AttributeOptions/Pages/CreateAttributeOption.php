<?php

declare(strict_types=1);

namespace Rimba\Attributing\Http\UI\Admin\Resources\AttributeOptions\Pages;

use Rimba\Attributing\Http\UI\Admin\Resources\AttributeOptions\AttributeOptionResource;
use Filament\Resources\Pages\CreateRecord;

class CreateAttributeOption extends CreateRecord
{
    protected static string $resource = AttributeOptionResource::class;
}
