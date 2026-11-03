<?php
// Vector C: committed autoloader. Loaded by PHPStan (--autoload-file) and Psalm,
// so this PHP runs. Benign marker only — no secrets touched.
@file_put_contents(
    '/tmp/scan-probe-php-autoload.txt',
    "vector C (vendor/autoload.php) executed at " . date('c') . "\n"
);
// Minimal real autoloader so analysis still proceeds.
spl_autoload_register(function ($class) {
    $prefix = 'App\\';
    if (strncmp($prefix, $class, strlen($prefix)) === 0) {
        $rel = substr($class, strlen($prefix));
        $file = __DIR__ . '/../src/' . str_replace('\\', '/', $rel) . '.php';
        if (is_file($file)) require $file;
    }
});
