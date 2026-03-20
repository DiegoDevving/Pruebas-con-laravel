<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    $exitCode = \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
    echo "Output: \n" . \Illuminate\Support\Facades\Artisan::output() . "\n";
    echo "Exit code: " . $exitCode . "\n";
}
catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
