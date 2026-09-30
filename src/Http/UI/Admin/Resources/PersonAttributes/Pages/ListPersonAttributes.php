<?php

declare(strict_types=1);

namespace Rimba\Attributing\Http\UI\Admin\Resources\PersonAttributes\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Rimba\Attributing\Http\UI\Admin\Resources\PersonAttributes\PersonAttributeResource;

class ListPersonAttributes extends ListRecords
{
    protected static string $resource = PersonAttributeResource::class;

    protected static ?string $title = 'Personnel Attributes';

    protected ?string $subheading = 'Listing of people attibutes';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
