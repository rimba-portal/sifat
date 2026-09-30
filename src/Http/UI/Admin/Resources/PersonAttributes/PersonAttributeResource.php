<?php

namespace Rimba\Attributing\Http\UI\Admin\Resources\PersonAttributes;

use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PersonAttributeResource extends Resource
{
    protected static ?string $model = \Rimba\Attributing\Models\PersonAttribute::class;

    protected static string|UnitEnum|null $navigationGroup = 'Attributing';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-play';

    protected static ?int $navigationSort = 22;

    protected static ?string $recordTitleAttribute = 'key';

    public static function form(Schema $schema): Schema { return \Rimba\Attributing\Http\UI\Admin\Resources\PersonAttributes\Schemas\PersonAttributeForm::configure($schema); }

    public static function infolist(Schema $schema): Schema { return $schema->components([]); }

    public static function table(Table $table): Table { return \Rimba\Attributing\Http\UI\Admin\Resources\PersonAttributes\Tables\PersonAttributesTable::configure($table); }

    public static function getRelations(): array 
    { 
        return [ 
            // 
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => \Rimba\Attributing\Http\UI\Admin\Resources\PersonAttributes\Pages\ListPersonAttributes::route('/'),
             'create' => \Rimba\Attributing\Http\UI\Admin\Resources\PersonAttributes\Pages\CreatePersonAttribute::route('/create'),
            // 'view' => \Rimba\Attributing\Http\UI\Admin\Resources\PersonAttributes\Pages\ViewPersonAttribute::route('/{record}'),
             'edit' => \Rimba\Attributing\Http\UI\Admin\Resources\PersonAttributes\Pages\EditPersonAttribute::route('/{record}/edit'),
            //
        ];
    }
}
