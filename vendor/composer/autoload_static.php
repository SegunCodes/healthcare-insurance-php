<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit8a48100306740fd35408c3c1d8f88f48
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit8a48100306740fd35408c3c1d8f88f48::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit8a48100306740fd35408c3c1d8f88f48::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit8a48100306740fd35408c3c1d8f88f48::$classMap;

        }, null, ClassLoader::class);
    }
}