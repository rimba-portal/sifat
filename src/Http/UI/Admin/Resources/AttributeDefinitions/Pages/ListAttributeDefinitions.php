<?php

declare(strict_types=1);

namespace Rimba\Attributing\Http\UI\Admin\Resources\AttributeDefinitions\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Rimba\Attributing\Http\UI\Admin\Resources\AttributeDefinitions\AttributeDefinitionResource;

class ListAttributeDefinitions extends ListRecords
{
    protected static string $resource = AttributeDefinitionResource::class;

    protected static ?string $title = 'Custom Attribute Definitions';

    protected ?string $subheading = 'Define shared configuration properties and structural asset traits.';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
