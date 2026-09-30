<?php

namespace Rimba\Attributing\Http\UI\Admin\Resources\AttributeDefinitions\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAttributeDefinitions extends ListRecords
{
    protected static string $resource = \Rimba\Attributing\Http\UI\Admin\Resources\AttributeDefinitions\AttributeDefinitionResource::class;

    protected static ?string $title = 'Custom Attribute Definitions';

    protected ?string $subheading = 'Define shared configuration properties and structural asset traits.';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
