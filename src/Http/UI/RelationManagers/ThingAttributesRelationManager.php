<?php

declare(strict_types=1);

namespace Rimba\Attributing\Http\UI\RelationManagers;

final class ThingAttributesRelationManager extends BaseAttributesRelationManager
{
    protected static string $relationship = 'thingAttributes';

    protected static ?string $title = 'Thing Attributes';

    protected static ?string $modelLabel = 'thing attribute';

    protected static ?string $pluralModelLabel = 'thing attributes';

    protected static string $keyPlaceholder =
        'e.g. serial_number, classification, capacity';
}
