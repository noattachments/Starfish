<?php

namespace Foundation\Providers;

class MigrationServiceProvider extends \Illuminate\Database\MigrationServiceProvider
{

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        // Dynamically load migrations from all directories under `src/Domain/Gamification/Database/Migrations`
        // You can load migrations from a custom directory
        // Find all migrations directories matching the pattern `src/Domain/*/Database/Migrations`
        $directories = glob(base_path('src/Domain/*/Database/Migrations'), GLOB_ONLYDIR);

        foreach ($directories as $directory) {
            // Load migrations from each directory
            $this->loadMigrationsFrom($directory);
        }
    }
}
