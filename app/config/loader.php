<?php

$loader = new \Phalcon\Loader();

/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader->registerDirs(
    [
        $config->application->controllersDir,
        $config->application->modelsDir
    ]
)->register();

$loader->registerNameSpaces(
    array(
        'App\Models' => $config->application->modelsDir,
        'App\Controlers' => $config->application->controllersDir,
    )
)->register();
