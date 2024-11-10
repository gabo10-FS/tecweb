<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit54e84694b99bea2c7a254b60cdaa5db0
{
    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'TECWEB\\MYAPI\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'TECWEB\\MYAPI\\' => 
        array (
            0 => __DIR__ . '/../..' . '/myapi',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit54e84694b99bea2c7a254b60cdaa5db0::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit54e84694b99bea2c7a254b60cdaa5db0::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit54e84694b99bea2c7a254b60cdaa5db0::$classMap;

        }, null, ClassLoader::class);
    }
}
