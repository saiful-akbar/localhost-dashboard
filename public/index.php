<?php

/**
 * Periksa apakah vendor composer sudah di install atau belum.
 */
if (!file_exists(__DIR__ . '/../vendor/autoload.php')) {
	throw new Exception('Please run "composer install"', 1);
}

/**
 * Composer autoload.
 */
require_once __DIR__ . '/../vendor/autoload.php';

/**
 * Tangkap parameter route
 * 
 * @var string
 */
$route = $_GET['route'] ?? 'home';
$route = trim($route, '/');

/**
 * Directory file view
 * 
 * @var string
 */
$view = __DIR__ . '/../views/' . $route . '.view.php';

/**
 * Periksa apakah ada view yang sesuai dengan
 * route yang direquest atau tidak ?
 */
if (!file_exists($view)) redirect(route('home'));

/**
 * Tampilkan view.
 */
require_once $view;
