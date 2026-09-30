<?php

namespace Rimba\Attributing\Http\UI\Admin\Resources\AttributeOptions\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAttributeOptions extends ListRecords
{
    protected static string $resource = \Rimba\Attributing\Http\UI\Admin\Resources\AttributeOptions\AttributeOptionResource::class;

    protected static ?string $title = 'Attribute Option Lists';

    protected ?string $subheading = 'Manage selectable value ranges used across standard data profiles.';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
