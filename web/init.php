<?php

require_once 'helpers.php';
require_once __DIR__ . '/../lib/autoload.php';
require_once __DIR__ . '/../vendor/autoload.php';

define('SITE_PUBLIC_ROOT', __DIR__);
define('SITE_TEMPLATE_DIR', SITE_PUBLIC_ROOT . '/../templates');
define('SITE_CACHE_DIR', SITE_PUBLIC_ROOT . '/../cache');
define('CONFIG_FILE_PATH', SITE_PUBLIC_ROOT . '/../config/config.yml');
define('TEMPLATE_CACHING_ENABLED', false);
