<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit764392ebfea3b1b3d2b28e6a65672863
{
    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'Cloudy4next\\NativeCloud\\' => 24,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Cloudy4next\\NativeCloud\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit764392ebfea3b1b3d2b28e6a65672863::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit764392ebfea3b1b3d2b28e6a65672863::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit764392ebfea3b1b3d2b28e6a65672863::$classMap;

        }, null, ClassLoader::class);
    }
}
