<?php

declare(strict_types=1);

namespace Rimba\Attributing\Http\UI\RelationManagers;

final class LocationAttributesRelationManager extends BaseAttributesRelationManager
{
    protected static string $relationship = 'locationAttributes';

    protected static ?string $title = 'Location Attributes';

    protected static ?string $modelLabel = 'location attribute';

    protected static ?string $pluralModelLabel = 'location attributes';

    protected static string $keyPlaceholder =
        'e.g. area, zone, floor, classification';
}
