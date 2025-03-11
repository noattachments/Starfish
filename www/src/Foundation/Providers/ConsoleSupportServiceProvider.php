<?php

namespace Foundation\Providers;

final class ConsoleSupportServiceProvider extends \Illuminate\Foundation\Providers\ConsoleSupportServiceProvider
{
    /**
     * The provider class names.
     *
     * @var array
     */
    protected $providers = [
        \Foundation\Providers\ArtisanServiceProvider::class,
        \Foundation\Providers\MigrationServiceProvider::class,
        \Illuminate\Foundation\Providers\ComposerServiceProvider::class,
//        \Foundation\Repository\RepositoryServiceProvider::class,
    ];
}
