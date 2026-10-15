<?php

declare(strict_types=1);

namespace Rimba\Attributing\Support;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

final class AttributeRoleName
{
    public const DELIMITER = '◇';

    public static function make(
        Model|string $model,
        string $key,
        string $value,
    ): string {
        $class = $model instanceof Model
            ? $model::class
            : $model;

        return implode(self::DELIMITER, [
            Str::snake(class_basename($class)),
            trim($key),
            trim($value),
        ]);
    }

    public static function isGenerated(string $role): bool
    {
        return str_contains($role, self::DELIMITER);
    }
}
