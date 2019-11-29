<?php
try {
    require __DIR__.'/vendor/autoload.php';
    
    $app = include_once 'bootstrap/app.php';
    
    $console = $app['cli'];
    
    $console->run();
} catch (\Exception $e) {
    echo $e->getMessage() . PHP_EOL;
}
