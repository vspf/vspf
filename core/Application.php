<?php

namespace Core;

class Application extends Singleton
{
    private static $name = 'dummy-webapp';
    private static $settings;

    public static function run()
    {
        self::$settings = ApplicationSettings::getInstance();
    }

    public function getName()
    {
        return self::$name;
    }

    /**
     * Set the application name
     * @param string $appName Name of the application
     * @return void
     */
    private function setName($appName)
    {
        self::$name = $appName;
    }

}