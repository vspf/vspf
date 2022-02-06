<?php

namespace Core;

class ApplicationSettings extends Singleton
{
    private static $settings;

    public static function loadFromFile($filename)
    {
        self::$settings = require($filename);
    }

    public static function get($param)
    {
        if(isset(self::$settings[$param]) )
        {
            return self::$settings[$param];
        }
        return null;
    }
}