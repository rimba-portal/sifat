<?php

declare(strict_types=1);

namespace Rimba\Attributing\Http\UI\Admin\Resources\PersonAttributes\Pages;

use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Rimba\Attributing\Http\UI\Admin\Resources\PersonAttributes\PersonAttributeResource;

class EditPersonAttribute extends EditRecord
{
    protected static string $resource = PersonAttributeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            Action::make('definition')
                ->tooltip('Definitions for Person Attributes')
                ->iconButton()
                ->icon('bites-design')
                ->action(fn () => redirect()->route('filament.admin.resources.attribute-definitions.person')),
        ];
    }
}
