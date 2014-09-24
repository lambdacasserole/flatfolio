<?php

require_once __DIR__ . '/../lib/autoload.php';
require_once __DIR__ . '/../vendor/autoload.php';

define('TEMPLATE_CACHING_ENABLED', false);

// Initialise template system.
$loader = new Twig_Loader_Filesystem(__DIR__ . '/twig');
$twig = new Twig_Environment($loader, array(
    'cache' => TEMPLATE_CACHING_ENABLED ? __DIR__ . '/cache' : false,
));
