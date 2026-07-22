<?php

declare(strict_types=1);

namespace Rimba\Attributing\Http\UI\Admin\Resources\AttributeDefinitions\Pages;

use Filament\Resources\Pages\CreateRecord;
use Rimba\Attributing\Http\UI\Admin\Resources\AttributeDefinitions\AttributeDefinitionResource;

class CreateAttributeDefinition extends CreateRecord
{
    protected static string $resource = AttributeDefinitionResource::class;
}
