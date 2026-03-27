<?php
/**
 * FortuneFlow Production Deployment Script
 * Use this to finalize the VTStack and Authentication updates.
 * Access at: http://fortunflow.site/deploy-vtstack.php
 * 
 * IMPORTANT: DELETE THIS FILE IMMEDIATELY AFTER RUNNING!
 */

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

header('Content-Type: text/plain');
echo "🚀 FortuneFlow Deployment Script\n";
echo "=================================\n\n";

try {
    // 1. Database Migrations
    echo "📦 Checking Database Schema...\n";
    $pdo = DB::connection()->getPdo();

    // Check settings table for VTStack fields
    $stmt = $pdo->query("SHOW COLUMNS FROM settings LIKE 'vtstack_api_key'");
    if (!$stmt->fetch()) {
        echo "   - Adding VTStack fields to 'settings' table...\n";
        DB::statement("ALTER TABLE settings ADD COLUMN vtstack_api_key VARCHAR(255) NULL AFTER payment_mode");
        DB::statement("ALTER TABLE settings ADD COLUMN vtstack_webhook_secret VARCHAR(255) NULL AFTER vtstack_api_key");
        DB::statement("ALTER TABLE settings ADD COLUMN virtual_gateway VARCHAR(50) DEFAULT 'payrant' AFTER vtstack_webhook_secret");
    } else {
        echo "   - Settings table already up to date.\n";
    }

    // Check users table for provider and username fields
    $stmt = $pdo->query("SHOW COLUMNS FROM users LIKE 'virtual_account_provider'");
    if (!$stmt->fetch()) {
        echo "   - Adding 'virtual_account_provider' to 'users' table...\n";
        DB::statement("ALTER TABLE users ADD COLUMN virtual_account_provider VARCHAR(50) DEFAULT 'payrant' AFTER virtual_account_name");
    } else {
        echo "   - User provider field already exists.\n";
    }

    $stmt = $pdo->query("SHOW COLUMNS FROM users LIKE 'username'");
    if (!$stmt->fetch()) {
        echo "   - Adding 'username' to 'users' table...\n";
        DB::statement("ALTER TABLE users ADD COLUMN username VARCHAR(255) NULL UNIQUE AFTER phone");
        
        // Populate username from phone initially if empty
        echo "   - Backfilling usernames from phone numbers...\n";
        DB::statement("UPDATE users SET username = CONCAT('u', phone) WHERE username IS NULL");
    } else {
        echo "   - Username field already exists.\n";
    }

    // 2. Clear System Caches
    echo "\n🧹 Clearing Application Caches...\n";
    Illuminate\Support\Facades\Artisan::call('cache:clear');
    Illuminate\Support\Facades\Artisan::call('config:clear');
    Illuminate\Support\Facades\Artisan::call('route:clear');
    Illuminate\Support\Facades\Artisan::call('view:clear');
    echo "   - Config, Route, and View caches cleared successfully!\n";

    echo "\n=================================\n";
    echo "✅ DEPLOYMENT SUCCESSFUL!\n";
    echo "=================================\n\n";
    echo "NEXT STEPS:\n";
    echo "1. Log into your Admin Panel.\n";
    echo "2. Go to Settings and enter your VTStack API Key and Webhook Secret.\n";
    echo "3. Change 'Payment Mode' to 'Virtual Account' and 'Virtual Gateway' to 'VTStack'.\n";
    echo "4. DELETE THIS FILE (/deploy-vtstack.php) from your server for security.\n";

} catch (\Exception $e) {
    echo "\n❌ ERROR DURING DEPLOYMENT:\n";
    echo $e->getMessage();
    echo "\n\nTrace:\n";
    echo $e->getTraceAsString();
}
