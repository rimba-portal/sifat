<?php

namespace Rimba\Attributing\Http\UI\Admin\Resources\ThingAttributes;

use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ThingAttributeResource extends Resource
{
    protected static ?string $model = \Rimba\Attributing\Models\ThingAttribute::class;

    protected static string|UnitEnum|null $navigationGroup = 'Attributing';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-play';

    protected static ?int $navigationSort = 23;

    protected static ?string $recordTitleAttribute = 'key';

    public static function form(Schema $schema): Schema { return \Rimba\Attributing\Http\UI\Admin\Resources\ThingAttributes\Schemas\ThingAttributeForm::configure($schema); }

    public static function infolist(Schema $schema): Schema { return $schema->components([]); }

    public static function table(Table $table): Table { return \Rimba\Attributing\Http\UI\Admin\Resources\ThingAttributes\Tables\ThingAttributesTable::configure($table); }

    public static function getRelations(): array 
    { 
        return [ 
            // 
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => \Rimba\Attributing\Http\UI\Admin\Resources\ThingAttributes\Pages\ListThingAttributes::route('/'),
             'create' => \Rimba\Attributing\Http\UI\Admin\Resources\ThingAttributes\Pages\CreateThingAttribute::route('/create'),
            // 'view' => \Rimba\Attributing\Http\UI\Admin\Resources\ThingAttributes\Pages\ViewThingAttribute::route('/{record}'),
             'edit' => \Rimba\Attributing\Http\UI\Admin\Resources\ThingAttributes\Pages\EditThingAttribute::route('/{record}/edit'),
            //
        ];
    }
}
