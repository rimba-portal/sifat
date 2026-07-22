<?php

declare(strict_types=1);

namespace Rimba\Attributing\Http\UI\Admin\Resources\AttributeOptions\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Rimba\Attributing\Http\UI\Admin\Resources\AttributeOptions\AttributeOptionResource;

class ListAttributeOptions extends ListRecords
{
    protected static string $resource = AttributeOptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
