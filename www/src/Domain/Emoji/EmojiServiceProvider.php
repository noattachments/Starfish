<?php

namespace Domain\Emoji;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class EmojiServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                \Domain\Emoji\Commands\ImportEmojiCollection::class,
            ]);
        }

        // Register custom routes
        $this->registerRoutes();
    }

    private function getAllData()
    {
        $data = Cache::remember('data', now()->addDay(1), function () {
            // This is the query you want to cache
            return \Domain\Emoji\Models\Emoji::all();
        });

        return $data;
    }

    private function getDataGroups()
    {
        $groups = Cache::remember('distinct_groups', now()->addDay(1), function () {
            return \Domain\Emoji\Models\Emoji::raw(function ($collection) {
                return $collection->distinct('group');
            });
        });

        return $groups;
    }

    private function getDataSubGroups()
    {
        $groups = Cache::remember('distinct_subgroups', now()->addDay(1), function () {
            // This is the query you want to cache
            return \Domain\Emoji\Models\Emoji::raw(function ($collection) {
                return $collection->distinct('subgroup');
            });
        });

        return $groups;
    }

    private function getDataTags()
    {
        $tags = Cache::remember('distinct_tags', now()->addDay(1), function () {
            // This is the query you want to cache
            return \Domain\Emoji\Models\Emoji::raw(function ($collection) {
                return $collection->distinct('tags');
            });
        });

        return $tags;
    }

    protected function registerRoutes()
    {
        Route::middleware('web') // Use 'web' for web routes
        ->prefix('api/emoji')
        ->group(function () {

            Route::get('/status', function () {
                return response()->json(['status' => 'Service is running']);
            });

            Route::get('/all', function(){
                return response()->json(
                    $this->getAllData()
                );
            });

            Route::get('groups/{group}', function($group){

                $groups = $this->getDataGroups();

                if(false === in_array($group, $groups)){
                    exit(sprintf('Cannot find %s in group', $group));
                }

                return response()->json(
                    \Domain\Emoji\Models\Emoji::where('group', $group)->get()
                );
            });

            Route::get('subgroups/{subgroup}', function($subgroup){

                $groups = $this->getDataSubGroups();

                if(false === in_array($subgroup, $groups)){
                    exit(sprintf('Cannot find %s in subgroup', $subgroup));
                }

                return response()->json(
                    \Domain\Emoji\Models\Emoji::where('subgroup', $subgroup)->get()
                );
            });

            Route::get('tags/{tag}', function($tag){

                $tags = $this->getDataTags();

                if(false === in_array($tag, $tags)){
                    exit(sprintf('Cannot find %s in tags', $tags));
                }

                return response()->json(
                    \Domain\Emoji\Models\Emoji::where('tags', $tag)->get()
                );
            });
        });
    }
}
