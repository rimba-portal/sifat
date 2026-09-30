<?php

namespace Rimba\Attributing\Http\UI\Admin\Resources\LocationAttributes;

use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class LocationAttributeResource extends Resource
{
    protected static ?string $model = \Rimba\Attributing\Models\LocationAttribute::class;

    protected static string|UnitEnum|null $navigationGroup = 'Attributing';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-play';

    protected static ?int $navigationSort = 21;

    protected static ?string $recordTitleAttribute = 'key';

    public static function form(Schema $schema): Schema { return \Rimba\Attributing\Http\UI\Admin\Resources\LocationAttributes\Schemas\LocationAttributeForm::configure($schema); }

    public static function infolist(Schema $schema): Schema { return \Rimba\Attributing\Http\UI\Admin\Resources\LocationAttributes\Schemas\LocationAttributeInfolist::configure($schema); }

    public static function table(Table $table): Table { return \Rimba\Attributing\Http\UI\Admin\Resources\LocationAttributes\Tables\LocationAttributesTable::configure($table); }

    public static function getRelations(): array 
    { 
        return [ 
            // 
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => \Rimba\Attributing\Http\UI\Admin\Resources\LocationAttributes\Pages\ListLocationAttributes::route('/'),
             'create' => \Rimba\Attributing\Http\UI\Admin\Resources\LocationAttributes\Pages\CreateLocationAttribute::route('/create'),
             'view' => \Rimba\Attributing\Http\UI\Admin\Resources\LocationAttributes\Pages\ViewLocationAttribute::route('/{record}'),
             'edit' => \Rimba\Attributing\Http\UI\Admin\Resources\LocationAttributes\Pages\EditLocationAttribute::route('/{record}/edit'),
            //
        ];
    }
}
