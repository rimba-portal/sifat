<?php

namespace Rimba\Attributing\Http\UI\Admin\Resources\AttributeOptions;

use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AttributeOptionResource extends Resource
{
    protected static ?string $model = \Rimba\Attributing\Models\AttributeOption::class;

    protected static string|UnitEnum|null $navigationGroup = 'Attributing';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-play';

    protected static ?int $navigationSort = 20;

    protected static ?string $recordTitleAttribute = 'label';

    public static function form(Schema $schema): Schema { return \Rimba\Attributing\Http\UI\Admin\Resources\AttributeOptions\Schemas\AttributeOptionForm::configure($schema); }

    public static function infolist(Schema $schema): Schema { return $schema->components([]); }

    public static function table(Table $table): Table { return \Rimba\Attributing\Http\UI\Admin\Resources\AttributeOptions\Tables\AttributeOptionsTable::configure($table); }

    public static function getRelations(): array 
    { 
        return [ 
            // 
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => \Rimba\Attributing\Http\UI\Admin\Resources\AttributeOptions\Pages\ListAttributeOptions::route('/'),
             'create' => \Rimba\Attributing\Http\UI\Admin\Resources\AttributeOptions\Pages\CreateAttributeOption::route('/create'),
            // 'view' => \Rimba\Attributing\Http\UI\Admin\Resources\AttributeOptions\Pages\ViewAttributeOption::route('/{record}'),
             'edit' => \Rimba\Attributing\Http\UI\Admin\Resources\AttributeOptions\Pages\EditAttributeOption::route('/{record}/edit'),
            //
        ];
    }
}
