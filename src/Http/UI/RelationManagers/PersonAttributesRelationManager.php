<?php

declare(strict_types=1);

namespace Rimba\Attributing\Http\UI\RelationManagers;

final class PersonAttributesRelationManager extends BaseAttributesRelationManager
{
    protected static string $relationship = 'personAttributes';

    protected static ?string $title = 'Person Attributes';

    protected static ?string $modelLabel = 'person attribute';

    protected static ?string $pluralModelLabel = 'person attributes';

    protected static string $keyPlaceholder =
        'e.g. nationality, shift_code, paygrade, qualification';
}
