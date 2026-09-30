<?php

namespace Rimba\Attributing\Http\UI\Admin\Resources\ThingAttributes\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListThingAttributes extends ListRecords
{
    protected static string $resource = \Rimba\Attributing\Http\UI\Admin\Resources\ThingAttributes\ThingAttributeResource::class;

    protected static ?string $title = 'Asset Properties';

    protected ?string $subheading = 'Listing of attibutes of things';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
