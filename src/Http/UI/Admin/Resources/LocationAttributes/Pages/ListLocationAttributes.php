<?php

declare(strict_types=1);

namespace Rimba\Attributing\Http\UI\Admin\Resources\LocationAttributes\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Rimba\Attributing\Http\UI\Admin\Resources\LocationAttributes\LocationAttributeResource;

class ListLocationAttributes extends ListRecords
{
    protected static string $resource = LocationAttributeResource::class;

    protected static ?string $title = 'Location Properties';

    protected ?string $subheading = 'Listing of location attibutes';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
