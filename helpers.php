<?php

if (!function_exists('url')) {

    /**
     * Fungsi auto generate url.
     */
    function url(string $path = '/', array $parameters = []): string
    {
    	$url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 'https://' : 'http://';
        $url .= $_SERVER['HTTP_HOST'];
        $url .= str_replace('index.php', '', $_SERVER['PHP_SELF']);
        $url .= trim(ltrim($path, '/'));

        if (count($parameters) > 0) {
            $url .= '?';

            foreach ($parameters as $key => $value) {
                $url .= "{$key}={$value}";

                if(array_key_last($parameters) != $key) {
                    $url .= '&';
                }
            }
        }

    	return $url;
    }
}

if (!function_exists('route')) {
    
    /**
     * Helper untuk membuat route url.
     */
    function route(string $name, string $path = '/', array $parameters = []): string
    {
        return url(path: $path, parameters: ['route' => $name, ...$parameters]);
    }
}

if (!function_exists('to')) {

    /**
     * Fungsi auto generate url.
     */
    function to(string $path = '/', array $parameters = []): string
    {
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
            $url = 'https://';
        } else {
            $url = 'http://';
        }

        $url .= $_SERVER['HTTP_HOST'];
        $url .= '/';
        $url .= trim(ltrim($path, '/'));

        if (count($parameters) > 0) {
            $url .= '?';

            foreach ($parameters as $key => $value) {
                $url .= "{$key}={$value}";

                if(array_key_last($parameters) != $key) {
                    $url .= '&';
                }
            }
        }

        return $url;
    }
}

if (!function_exists('get_name')) {
    
    /**
     * Fungsi auto generate name dari directory.
     */
    function get_name(string $name): string
    {
    	return strtoupper(str_replace('-', ' ', $name));
    }
}

if (!function_exists('view')) {
    
    /**
     * Mengambil view
     */
    function view(string $view, array $parameters = []): void
    {
        extract($parameters);
        require __DIR__ . '/views/' . trim($view) . '.view.php';
    }
}

if (!function_exists('root_dir')) {
    
    /**
     * Root directory
     */
    function root_dir(?string $path = null): string
    {
        if (is_null($path)) {
            return __DIR__;
        }

        return __DIR__ . $path;
    }
}

if (!function_exists('redirect')) {
    
    /**
     * Fungsi helper untuk redirect url.
     */
    function redirect(string $url): void
    {
        header('location:' . $url);
        exit();
    }
}
