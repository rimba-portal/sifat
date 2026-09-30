<?php

declare(strict_types=1);

namespace Rimba\Attributing\Http\UI\Admin\Resources\AttributeOptions;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Rimba\Attributing\Http\UI\Admin\Resources\AttributeOptions\Pages\CreateAttributeOption;
use Rimba\Attributing\Http\UI\Admin\Resources\AttributeOptions\Pages\EditAttributeOption;
use Rimba\Attributing\Http\UI\Admin\Resources\AttributeOptions\Pages\ListAttributeOptions;
use Rimba\Attributing\Http\UI\Admin\Resources\AttributeOptions\Schemas\AttributeOptionForm;
use Rimba\Attributing\Http\UI\Admin\Resources\AttributeOptions\Tables\AttributeOptionsTable;
use Rimba\Attributing\Models\AttributeOption;
use UnitEnum;

class AttributeOptionResource extends Resource
{
    protected static ?string $model = AttributeOption::class;

    protected static string|UnitEnum|null $navigationGroup = 'Attributing';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-play';

    protected static ?int $navigationSort = 20;

    protected static ?string $recordTitleAttribute = 'label';

    public static function form(Schema $schema): Schema
    {
        return AttributeOptionForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema->components([]);
    }

    public static function table(Table $table): Table
    {
        return AttributeOptionsTable::configure($table);
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
            'index' => ListAttributeOptions::route('/'),
            'create' => CreateAttributeOption::route('/create'),
            // 'view' => \Rimba\Attributing\Http\UI\Admin\Resources\AttributeOptions\Pages\ViewAttributeOption::route('/{record}'),
            'edit' => EditAttributeOption::route('/{record}/edit'),
            //
        ];
    }
}
