<?php

declare(strict_types=1);

namespace Rimba\Attributing\Http\UI\Admin\Resources\LocationAttributes\Pages;

use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;
use Rimba\Attributing\Http\UI\Admin\Resources\LocationAttributes\LocationAttributeResource;

class EditLocationAttribute extends EditRecord
{
    protected static string $resource = LocationAttributeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),

            Action::make('definition')
                ->tooltip('Definitions for Location Attributes')
                ->iconButton()
                ->icon('rimba-design')
                ->action(fn () => redirect()->route('filament.admin.resources.attribute-definitions.location')),
        ];
    }
}
