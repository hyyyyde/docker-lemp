<?php

class Container
{

    public static $environment = 'prod';

    public static function setEnvironment($environment)
    {
        self::$environment = $environment;
    }

    public static function getEnvironment()
    {
        return self::$environment;
    }
}
