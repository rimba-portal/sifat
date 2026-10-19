<?php

declare(strict_types=1);

namespace Rimba\Attributing\Support;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

final class AttributeSubject
{
    public static function for(Model|string $model): string
    {
        $class = $model instanceof Model
            ? $model::class
            : $model;

        return Str::snake(class_basename($class));
    }
}
