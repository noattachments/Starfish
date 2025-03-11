<?php

namespace Foundation\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

abstract class DomainFactory extends Factory
{
    /**
     * The default namespace where factories reside.
     *
     * @var string
     */
    public static $namespace =  'Domain\\*\\Database\\Factories\\';

    private static function getRootFolder(): string
    {
        return 'src'.DIRECTORY_SEPARATOR;
    }

    private static function getDirectoryWildcard()
    {
        $directoryWildcard = str_replace(['\\'], ['/'], static::$namespace);
        return base_path(static::getRootFolder().$directoryWildcard);
    }

    /**
     * Get a new factory instance for the given model name.
     *
     * @param  class-string<\Illuminate\Database\Eloquent\Model>  $modelName
     * @return \Foundation\Infrastructure\Factories\DomainFactory
     */
    public static function factoryForModel(string $modelName)
    {
        $factory = static::resolveFactoryName($modelName);

        return $factory::new();
    }

    /**
     * Get the factory name for the given model name.
     *
     * @param  class-string<\Illuminate\Database\Eloquent\Model>  $modelName
     * @return class-string<\Foundation\Infrastructure\Factories\DomainFactory>
     */
    final public static function resolveFactoryName(string $modelName): string
    {

        $fullyQualifiedModelName = $modelName;

        $modelName = class_basename($fullyQualifiedModelName);

        $directoryPath = glob(self::getDirectoryWildcard(), GLOB_ONLYDIR);

//        dd($fullyQualifiedModelName, $modelName);

        foreach ($directoryPath as $directory) {
            if(file_exists($directory.$modelName.'Factory.php')){
                $factory = str_replace(['Models'], ['Database\\Factories'], $fullyQualifiedModelName);
            }
        }

        return $factory.'Factory';
    }
}
