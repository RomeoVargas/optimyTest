<?php
if (!function_exists('env')) {
    function env($environmentVariable, $default = null) {
        return !isset($_ENV[$environmentVariable])
            ? $default
            : $_ENV[$environmentVariable];
    }
}

if (!function_exists('collect_as')) {
    function collect_as($collection, $collectAsClassName) {
        $newCollection = [];

        foreach ($collection as $item) {
            $newCollection[] = new $collectAsClassName($item);
        }
        unset($collection);
        unset($collectAsClassName);

        return $newCollection;
    }
}

if (!function_exists('sanitize')) {
    function sanitize($var) {
        if (!is_array($var)) {
            return filter_var($var, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }

        $sanitizedVar = [];
        foreach ($var as $unsanitizedIndex => $unsanitizedVar) {
            $sanitizedIndex = filter_var($unsanitizedIndex, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $sanitizedVar[$sanitizedIndex] = sanitize($unsanitizedVar);
        }

        return $sanitizedVar;
    }
}

if (!function_exists('display_page')) {
    function display_page($pageName, $usableVars = []) {
        foreach ($usableVars as $variableName => $value) {
            $$variableName = $value;
        }

        require_once __DIR__ .'/../views/'.$pageName.'.php';
    }
}

if (!function_exists('redirect')) {
    function redirect($route) {
        $redirectUrl = sprintf(
            '%s://%s/%s',
            isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
            $_SERVER['SERVER_NAME'],
            $route
        );
        header('Location: '.rtrim($redirectUrl, '/'));
        exit();
    }
}