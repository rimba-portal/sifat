<?php

declare(strict_types=1);

namespace Rimba\Attributing\Http\UI\Admin\Resources\LocationAttributes\Pages;

use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Rimba\Attributing\Http\UI\Admin\Resources\LocationAttributes\LocationAttributeResource;

class ViewLocationAttribute extends ViewRecord
{
    protected static string $resource = LocationAttributeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
            Action::make('definition')
                ->tooltip('Definitions for Location Attributes')
                ->iconButton()
                ->icon('rimba-design')
                ->action(fn () => redirect()->route('filament.admin.resources.attribute-definitions.location')),

        ];
    }
}
