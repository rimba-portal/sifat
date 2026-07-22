<?php

declare(strict_types=1);

namespace Rimba\Attributing\Http\UI\Admin\Resources\AttributeOptions\Pages;

use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Rimba\Attributing\Http\UI\Admin\Resources\AttributeOptions\AttributeOptionResource;

class EditAttributeOption extends EditRecord
{
    protected static string $resource = AttributeOptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
