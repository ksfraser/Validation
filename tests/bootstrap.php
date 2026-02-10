<?php

$autoload = __DIR__ . '/../vendor/autoload.php';
if (file_exists($autoload)) {
    require_once $autoload;
    return;
}

spl_autoload_register(static function (string $class): void {
    $prefixes = [
        'Ksfraser\\Validation\\Tests\\' => __DIR__ . '/',
        'Ksfraser\\Validation\\' => __DIR__ . '/../src/',
    ];

    foreach ($prefixes as $prefix => $baseDir) {
        if (strncmp($class, $prefix, strlen($prefix)) !== 0) {
            continue;
        }

        $relative = substr($class, strlen($prefix));
        $relativePath = str_replace('\\', '/', $relative) . '.php';
        $path = $baseDir . $relativePath;

        if (file_exists($path)) {
            require_once $path;
        }

        return;
    }
});
