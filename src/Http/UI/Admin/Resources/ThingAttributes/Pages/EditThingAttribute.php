<?php

declare(strict_types=1);

namespace Rimba\Attributing\Http\UI\Admin\Resources\ThingAttributes\Pages;

use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Rimba\Attributing\Http\UI\Admin\Resources\ThingAttributes\ThingAttributeResource;

class EditThingAttribute extends EditRecord
{
    protected static string $resource = ThingAttributeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            Action::make('definition')
                ->tooltip('Definitions for Thing Attributes')
                ->iconButton()
                ->icon('rimba-design')
                ->action(fn () => redirect()->route('filament.admin.resources.attribute-definitions.thing')),
        ];
    }
}
