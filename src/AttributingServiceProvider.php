<?php

declare(strict_types=1);

namespace Rimba\Attributing;

use Rimba\Attributing\Console\Commands\RebuildAbacRolesCommand;
use Rimba\Attributing\Macros\LockWhenFilledMacro;
use Rimba\Base\Services\BitesServiceProvider;

class AttributingServiceProvider extends BitesServiceProvider
{
    protected string $configFile = __DIR__.'/../config/bites.php';

    protected string $iconsPath = __DIR__.'/../resources/svg';

    protected function bootPackage(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        LockWhenFilledMacro::register();
        if ($this->app->runningInConsole()) {
            $this->commands([
                RebuildAbacRolesCommand::class,
            ]);
        }
    }

    protected function registerPackage(): void
    {
        //
    }
}
