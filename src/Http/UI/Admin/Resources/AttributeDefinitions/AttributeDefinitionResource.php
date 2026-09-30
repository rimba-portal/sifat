<?php

declare(strict_types=1);

namespace Rimba\Attributing\Http\UI\Admin\Resources\AttributeDefinitions;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Rimba\Attributing\Http\UI\Admin\Resources\AttributeDefinitions\Pages\CreateAttributeDefinition;
use Rimba\Attributing\Http\UI\Admin\Resources\AttributeDefinitions\Pages\EditAttributeDefinition;
use Rimba\Attributing\Http\UI\Admin\Resources\AttributeDefinitions\Pages\ListAttributeDefinitions;
use Rimba\Attributing\Http\UI\Admin\Resources\AttributeDefinitions\Pages\ListLocationAttributeDefinitions;
use Rimba\Attributing\Http\UI\Admin\Resources\AttributeDefinitions\Pages\ListPersonAttributeDefinitions;
use Rimba\Attributing\Http\UI\Admin\Resources\AttributeDefinitions\Pages\ListThingAttributeDefinitions;
use Rimba\Attributing\Http\UI\Admin\Resources\AttributeDefinitions\Schemas\AttributeDefinitionForm;
use Rimba\Attributing\Http\UI\Admin\Resources\AttributeDefinitions\Tables\AttributeDefinitionsTable;
use Rimba\Attributing\Models\AttributeDefinition;
use UnitEnum;

class AttributeDefinitionResource extends Resource
{
    protected static ?string $model = AttributeDefinition::class;

    protected static string|UnitEnum|null $navigationGroup = 'Attributing';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-play';

    protected static ?int $navigationSort = 19;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return AttributeDefinitionForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema->components([]);
    }

    public static function table(Table $table): Table
    {
        return AttributeDefinitionsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAttributeDefinitions::route('/'),
            'create' => CreateAttributeDefinition::route('/create'),
            // 'view' => \Rimba\Attributing\Http\UI\Admin\Resources\AttributeDefinitions\Pages\ViewAttributeDefinition::route('/{record}'),
            'edit' => EditAttributeDefinition::route('/{record}/edit'),
            'person' => ListPersonAttributeDefinitions::route('/person'),
            'thing' => ListThingAttributeDefinitions::route('/thing'),
            'location' => ListLocationAttributeDefinitions::route('/location'),
        ];
    }
}
