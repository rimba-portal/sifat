<?php

namespace Rimba\Attributing\Http\UI\Admin\Resources\AttributeDefinitions;

use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AttributeDefinitionResource extends Resource
{
    protected static ?string $model = \Rimba\Attributing\Models\AttributeDefinition::class;

    protected static string|UnitEnum|null $navigationGroup = 'Attributing';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-play';

    protected static ?int $navigationSort = 19;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema { return \Rimba\Attributing\Http\UI\Admin\Resources\AttributeDefinitions\Schemas\AttributeDefinitionForm::configure($schema); }

    public static function infolist(Schema $schema): Schema { return $schema->components([]); }

    public static function table(Table $table): Table { return \Rimba\Attributing\Http\UI\Admin\Resources\AttributeDefinitions\Tables\AttributeDefinitionsTable::configure($table); }

    public static function getRelations(): array 
    { 
        return [ 
            // 
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => \Rimba\Attributing\Http\UI\Admin\Resources\AttributeDefinitions\Pages\ListAttributeDefinitions::route('/'),
             'create' => \Rimba\Attributing\Http\UI\Admin\Resources\AttributeDefinitions\Pages\CreateAttributeDefinition::route('/create'),
            // 'view' => \Rimba\Attributing\Http\UI\Admin\Resources\AttributeDefinitions\Pages\ViewAttributeDefinition::route('/{record}'),
             'edit' => \Rimba\Attributing\Http\UI\Admin\Resources\AttributeDefinitions\Pages\EditAttributeDefinition::route('/{record}/edit'),
            'person' => \Rimba\Attributing\Http\UI\Admin\Resources\AttributeDefinitions\Pages\ListPersonAttributeDefinitions::route('/person'),
'thing' => \Rimba\Attributing\Http\UI\Admin\Resources\AttributeDefinitions\Pages\ListThingAttributeDefinitions::route('/thing'),
'location' => \Rimba\Attributing\Http\UI\Admin\Resources\AttributeDefinitions\Pages\ListLocationAttributeDefinitions::route('/location'),
        ];
    }
}
