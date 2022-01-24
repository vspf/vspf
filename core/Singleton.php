<?php

namespace Core;

class Singleton
{
    protected static $instances = [];

    public static function getInstance()
    {
        $className = static::class;

        if(!isset(self::$instances[$className])) {
            self::$instances[$className]= new static();
        }

        return self::$instances[$className];
    }
}