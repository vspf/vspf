<?php

namespace Core;

class Singleton
{
    /**
     * @var array Singleton instances list
     */
    protected static $instances = [];

    /**
     * @return mixed|static
     */
    public static function getInstance()
    {
        $className = static::class;

        if(!isset(self::$instances[$className])) {
            self::$instances[$className]= new static();
        }

        return self::$instances[$className];
    }
}