<?php

declare(strict_types=1);

namespace Rimba\Attributing\Http\UI\Admin\Resources\AttributeDefinitions\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;
use Rimba\Attributing\Http\UI\Admin\Resources\AttributeDefinitions\AttributeDefinitionResource;

abstract class ListFamilyAttributeDefinitions extends ListRecords
{
    protected static string $resource = AttributeDefinitionResource::class;

    protected string $family;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->mutateDataUsing(function (array $data): array {
                    $data['family'] = $this->family;

                    return $data;
                }),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All')
                ->modifyQueryUsing(
                    fn (Builder $query): Builder => $query->where('family', $this->family),
                ),
            ...$this->getGroupTabs(),
        ];
    }

    protected function getGroupTabs(): array
    {
        $tabs = [];

        foreach (config('bites.groups.'.$this->family, []) as $key => $label) {
            $tabs[$key] = Tab::make($label)
                ->modifyQueryUsing(
                    fn (Builder $query): Builder => $query
                        ->where('family', $this->family)
                        ->where('group', $key),
                );
        }

        return $tabs;
    }
}
