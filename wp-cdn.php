<?php

/*
Plugin Name: Dang Media WP CDN
Description: Minimalistic CDN Plugin for Dev purpose
Version: 0.0.1
Author: Trung Dang
Author URI: https://trungdang.de
Text Domain: wp-cdn
*/

use DM\WPCdn\Bootstrap;

if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    $loader = require_once __DIR__ . '/vendor/autoload.php';
    $loader->addPsr4('DM\\WPCdn\\', __DIR__ . '/src/');
}

add_action('plugins_loaded', array(Bootstrap::getInstance(), 'init'));
