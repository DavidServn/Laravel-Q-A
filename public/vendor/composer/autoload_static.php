<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit05cf57337bf820bb6682ae5ddf8f8141
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Predis\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Predis\\' => 
        array (
            0 => __DIR__ . '/..' . '/predis/predis/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit05cf57337bf820bb6682ae5ddf8f8141::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit05cf57337bf820bb6682ae5ddf8f8141::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
