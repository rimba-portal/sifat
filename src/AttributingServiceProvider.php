<?php

declare(strict_types=1);

namespace Rimba\Attributing;

use Rimba\Base\BitesServiceProvider;
use Rimba\Attributing\Macros\LockWhenFilledMacro;


class AttributingServiceProvider extends BitesServiceProvider
{
    protected string $configFile = __DIR__ . '/../config/bites.php';
    protected string $iconsPath = __DIR__ . '/../resources/svg';

    protected function bootPackage(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        LockWhenFilledMacro::register();

    }
    protected function registerPackage(): void
    {
        //
    }

}
