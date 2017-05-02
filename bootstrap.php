<?php

define('APP_ENV',
    getenv('APP_ENV') ?: 'dev'
);

define('APP_DEBUG',
    APP_ENV !== 'prod' && (
    getenv('APP_DEBUG') !== false
        ? filter_var(getenv('APP_DEBUG'), FILTER_VALIDATE_BOOLEAN)
        : true
    )
);

/** @var Composer\Autoload\ClassLoader $loader */
$loader = require __DIR__ . '/lib/autoload.php';

Doctrine\Common\Annotations\AnnotationRegistry::registerLoader([$loader, 'loadClass']);

return $loader;
