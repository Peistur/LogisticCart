<?php

require __DIR__ . '/../bootstrap.php';

APP_DEBUG && Symfony\Component\Debug\Debug::enable();
$kernel = new Kernel(APP_ENV, APP_DEBUG);
$request = Symfony\Component\HttpFoundation\Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
