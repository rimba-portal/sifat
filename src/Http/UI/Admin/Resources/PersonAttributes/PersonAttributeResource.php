<?php

declare(strict_types=1);

namespace Rimba\Attributing\Http\UI\Admin\Resources\PersonAttributes;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Rimba\Attributing\Http\UI\Admin\Resources\PersonAttributes\Pages\CreatePersonAttribute;
use Rimba\Attributing\Http\UI\Admin\Resources\PersonAttributes\Pages\EditPersonAttribute;
use Rimba\Attributing\Http\UI\Admin\Resources\PersonAttributes\Pages\ListPersonAttributes;
use Rimba\Attributing\Http\UI\Admin\Resources\PersonAttributes\Schemas\PersonAttributeForm;
use Rimba\Attributing\Http\UI\Admin\Resources\PersonAttributes\Tables\PersonAttributesTable;
use Rimba\Attributing\Models\PersonAttribute;
use UnitEnum;

class PersonAttributeResource extends Resource
{
    protected static ?string $model = PersonAttribute::class;

    protected static string|UnitEnum|null $navigationGroup = 'Attributing';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-play';

    protected static ?int $navigationSort = 22;

    protected static ?string $recordTitleAttribute = 'key';

    public static function form(Schema $schema): Schema
    {
        return PersonAttributeForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema->components([]);
    }

    public static function table(Table $table): Table
    {
        return PersonAttributesTable::configure($table);
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
            'index' => ListPersonAttributes::route('/'),
            'create' => CreatePersonAttribute::route('/create'),
            // 'view' => \Rimba\Attributing\Http\UI\Admin\Resources\PersonAttributes\Pages\ViewPersonAttribute::route('/{record}'),
            'edit' => EditPersonAttribute::route('/{record}/edit'),
            //
        ];
    }
}
