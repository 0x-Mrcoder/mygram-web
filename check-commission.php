<?php
// Debug script to check commission settings
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== COMMISSION DEBUG INFO ===\n\n";

// Check if ReferralHelper exists
if (class_exists('App\Helpers\ReferralHelper')) {
    echo "✅ ReferralHelper class EXISTS\n";
} else {
    echo "❌ ReferralHelper class NOT FOUND\n";
}

// Check database settings
$setting = App\Models\Setting::first();
if ($setting) {
    echo "\n--- Database Settings ---\n";
    echo "Level 1 Commission: " . ($setting->level1_commission_percent ?? 'NOT SET') . "%\n";
    echo "Level 2 Commission: " . ($setting->level2_commission_percent ?? 'NOT SET') . "%\n";
    echo "Level 3 Commission: " . ($setting->level3_commission_percent ?? 'NOT SET') . "%\n";
} else {
    echo "❌ No settings found in database\n";
}

// Test commission calculation
echo "\n--- Test Calculation (₦15,000 package) ---\n";
if (class_exists('App\Helpers\ReferralHelper')) {
    $level1 = App\Helpers\ReferralHelper::calculateCommission(15000, 1);
    $level2 = App\Helpers\ReferralHelper::calculateCommission(15000, 2);
    $level3 = App\Helpers\ReferralHelper::calculateCommission(15000, 3);
    
    echo "Level 1: ₦" . number_format($level1, 2) . "\n";
    echo "Level 2: ₦" . number_format($level2, 2) . "\n";
    echo "Level 3: ₦" . number_format($level3, 2) . "\n";
    echo "Total: ₦" . number_format($level1 + $level2 + $level3, 2) . "\n";
}

echo "\n=== END DEBUG ===\n";
