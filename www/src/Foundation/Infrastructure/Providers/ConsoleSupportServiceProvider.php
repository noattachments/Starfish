<?php

namespace Foundation\Infrastructure\Providers;

final class ConsoleSupportServiceProvider extends \Illuminate\Foundation\Providers\ConsoleSupportServiceProvider
{
    /**
     * The provider class names.
     *
     * @var array
     */
    protected $providers = [
        \Foundation\Infrastructure\Providers\ArtisanServiceProvider::class,
        \Foundation\Infrastructure\Providers\MigrationServiceProvider::class,
        \Illuminate\Foundation\Providers\ComposerServiceProvider::class,
//        \Foundation\Repository\RepositoryServiceProvider::class,
    ];
}
