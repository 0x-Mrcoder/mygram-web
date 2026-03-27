<?php
/**
 * Cache Clear Script
 * 
 * Upload this file to your cPanel public_html or project root.
 * Visit: https://yourdomain.com/clear-cache.php
 * 
 * This will clear all Laravel caches.
 */

// Change this to your actual project path on cPanel
$projectPath = __DIR__;

// Include Laravel's autoloader
require $projectPath . '/vendor/autoload.php';

// Bootstrap Laravel application
$app = require_once $projectPath . '/bootstrap/app.php';

// Make the kernel and bootstrap the application
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "<h1>Laravel Cache Clearer</h1>";
echo "<p>Clearing caches...</p>";
echo "<hr>";

// Clear Config Cache
echo "<p>✅ Clearing Config Cache...</p>";
try {
    $kernel->call('config:clear');
    echo "<pre>Config cache cleared successfully!</pre>";
} catch (Exception $e) {
    echo "<pre style='color:red;'>Error: " . $e->getMessage() . "</pre>";
}

// Clear Route Cache
echo "<p>✅ Clearing Route Cache...</p>";
try {
    $kernel->call('route:clear');
    echo "<pre>Route cache cleared successfully!</pre>";
} catch (Exception $e) {
    echo "<pre style='color:red;'>Error: " . $e->getMessage() . "</pre>";
}

// Clear View Cache
echo "<p>✅ Clearing View Cache...</p>";
try {
    $kernel->call('view:clear');
    echo "<pre>View cache cleared successfully!</pre>";
} catch (Exception $e) {
    echo "<pre style='color:red;'>Error: " . $e->getMessage() . "</pre>";
}

// Clear Application Cache
echo "<p>✅ Clearing Application Cache...</p>";
try {
    $kernel->call('cache:clear');
    echo "<pre>Application cache cleared successfully!</pre>";
} catch (Exception $e) {
    echo "<pre style='color:red;'>Error: " . $e->getMessage() . "</pre>";
}

echo "<hr>";
echo "<h2 style='color: green;'>✅ All Caches Cleared Successfully!</h2>";
echo "<p>You can now delete this file for security.</p>";
