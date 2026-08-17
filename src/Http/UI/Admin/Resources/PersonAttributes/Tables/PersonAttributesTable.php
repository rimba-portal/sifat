<?php

declare(strict_types=1);

namespace Rimba\Attributing\Http\UI\Admin\Resources\PersonAttributes\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Grouping\Group;

class PersonAttributesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                return $query->select(['key', 'value',])
                    ->selectRaw('MIN(id) as id')
                    ->selectRaw('COUNT(*) as count')
                    ->groupBy('key', 'value');
            })
            ->groups([Group::make('key')->collapsible(),])
            ->collapsedGroupsByDefault()
            ->defaultGroup('key')
            ->paginated(false)
            ->columns([
                TextColumn::make('key')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('value')
                    ->searchable()
                    ->wrap()->sortable(),
                TextColumn::make('count')
                    ->label('Occurrences')
                    ->numeric()
                    ->sortable(),
            ]);
    }
}
