<?php

/**
 * Public path.
 * 
 * @var string
 */
$publicPath = __DIR__ . '/public';

/**
 * Path url (uri)
 * 
 * @var string
 */
$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? ''
);

/**
 * File ini memungkinkan kita untuk meniru fungsionalitas "mod_rewrite" Apache dari
 * server web PHP bawaan. Ini memberikan cara mudah untuk menguji aplikasi
 * tanpa menginstal perangkat lunak server web "nyata" di sini.
 */
if ($uri !== '/' && file_exists($publicPath . $uri)) {
    return false;
}

require_once $publicPath . '/index.php';
