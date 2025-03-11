<?php

namespace Foundation\Factories;

trait HasFactory
{
    /**
     * Get a new factory instance for the model.
     *
     * @param  callable|array|int|null  $count
     * @param callable|array $state
     * @return \Foundation\Factories\DomainFactory<static>
     */
    public static function factory($count = null, callable|array $state = []): DomainFactory
    {
        $factory = DomainFactory::factoryForModel(get_called_class());

        return $factory
            ->count(is_numeric($count) ? $count : null)
            ->state(is_callable($count) || is_array($count) ? $count : $state);
    }
}
