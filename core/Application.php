<?php

namespace Core;

class Application extends Singleton
{
    private static $name = 'dummy-webapp';
    private static $settings;

    public static function run() : string
    {
        self::$settings = ApplicationSettings::getInstance();
        return "Application name: " . self::getName() . " of class " . __CLASS__ . " " . PHP_EOL;
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