<?php

declare(strict_types=1);

namespace Rimba\Attributing\Http\UI\Admin\Resources\AttributeDefinitions\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

final class AttributeDefinitionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('family')
                ->options(config('bites.families', []))
                ->live()
                ->required(),

            Select::make('group')
                ->options(fn (Get $get): array => config('bites.groups.'.$get('family'), []))
                ->required(),

            TextInput::make('key')
                ->required()
                ->maxLength(255),

            TextInput::make('name')
                ->required()
                ->maxLength(255),

            Textarea::make('description')
                ->columnSpanFull(),

            TagsInput::make('applies_to')
                ->columnSpanFull(),

            TextInput::make('example_key'),
            TextInput::make('example_value'),

            Toggle::make('has_options')
                ->default(false),

            Toggle::make('is_active')
                ->default(true),

            Toggle::make('is_abac')
                ->default(false),

            Toggle::make('is_system')
                ->default(false),

            TextInput::make('sort_order')
                ->numeric()
                ->default(0)
                ->required(),
        ]);
    }
}
