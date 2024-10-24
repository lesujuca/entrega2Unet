<?php

$dirs = [
    '/tmp/framework/cache/data',
    '/tmp/framework/sessions',
    '/tmp/framework/testing',
    '/tmp/framework/views',
    '/tmp/logs'
];

foreach ($dirs as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
}

// Incluir el archivo de inicio de Laravel
require __DIR__.'/public/index.php';