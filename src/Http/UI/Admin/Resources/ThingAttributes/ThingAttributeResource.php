<?php

declare(strict_types=1);

namespace Rimba\Attributing\Http\UI\Admin\Resources\ThingAttributes;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Rimba\Attributing\Http\UI\Admin\Resources\ThingAttributes\Pages\CreateThingAttribute;
use Rimba\Attributing\Http\UI\Admin\Resources\ThingAttributes\Pages\EditThingAttribute;
use Rimba\Attributing\Http\UI\Admin\Resources\ThingAttributes\Pages\ListThingAttributes;
use Rimba\Attributing\Http\UI\Admin\Resources\ThingAttributes\Schemas\ThingAttributeForm;
use Rimba\Attributing\Http\UI\Admin\Resources\ThingAttributes\Tables\ThingAttributesTable;
use Rimba\Attributing\Models\ThingAttribute;
use UnitEnum;

class ThingAttributeResource extends Resource
{
    protected static ?string $model = ThingAttribute::class;

    protected static string|UnitEnum|null $navigationGroup = 'Attributing';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-play';

    protected static ?int $navigationSort = 23;

    protected static ?string $recordTitleAttribute = 'key';

    public static function form(Schema $schema): Schema
    {
        return ThingAttributeForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema->components([]);
    }

    public static function table(Table $table): Table
    {
        return ThingAttributesTable::configure($table);
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
            'index' => ListThingAttributes::route('/'),
            'create' => CreateThingAttribute::route('/create'),
            // 'view' => \Rimba\Attributing\Http\UI\Admin\Resources\ThingAttributes\Pages\ViewThingAttribute::route('/{record}'),
            'edit' => EditThingAttribute::route('/{record}/edit'),
            //
        ];
    }
}
