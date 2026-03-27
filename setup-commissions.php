<?php
/**
 * Migration Script - Add Multi-Level Commission Fields
 * 
 * Upload this file to your cPanel project root (same location as clear-cache.php).
 * Visit: https://uniqwealth.site/setup-commissions.php
 * 
 * IMPORTANT: Delete this file after running!
 */

$projectPath = __DIR__;

require $projectPath . '/vendor/autoload.php';
$app = require_once $projectPath . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "<h1>Multi-Level Commission Setup</h1>";
echo "<hr>";

try {
    // Check if migration already ran
    $pdo = DB::connection()->getPdo();
    $stmt = $pdo->query("SHOW COLUMNS FROM settings LIKE 'level1_commission_percent'");
    $exists = $stmt->fetch();
    
    if ($exists) {
        echo "<p>✅ Commission fields already exist in database.</p>";
    } else {
        echo "<p>⏳ Adding commission fields to database...</p>";
        
        DB::statement("ALTER TABLE settings ADD COLUMN level1_commission_percent DECIMAL(5,2) DEFAULT 8.00 AFTER refer_commission");
        DB::statement("ALTER TABLE settings ADD COLUMN level2_commission_percent DECIMAL(5,2) DEFAULT 2.00 AFTER level1_commission_percent");
        DB::statement("ALTER TABLE settings ADD COLUMN level3_commission_percent DECIMAL(5,2) DEFAULT 1.00 AFTER level2_commission_percent");
        
        echo "<p style='color: green;'>✅ Commission fields added successfully!</p>";
    }
    
    // Update settings
    $setting = App\Models\Setting::first();
    if ($setting) {
        $setting->level1_commission_percent = 8.00;
        $setting->level2_commission_percent = 2.00;
        $setting->level3_commission_percent = 1.00;
        $setting->save();
        
        echo "<p>✅ Commission percentages set:</p>";
        echo "<ul>";
        echo "<li>Level 1: <strong>8%</strong></li>";
        echo "<li>Level 2: <strong>2%</strong></li>";
        echo "<li>Level 3: <strong>1%</strong></li>";
        echo "</ul>";
    }
    
    // Clear caches
    echo "<p>⏳ Clearing caches...</p>";
    $kernel->call('cache:clear');
    $kernel->call('config:clear');
    $kernel->call('route:clear');
    $kernel->call('view:clear');
    echo "<p>✅ All caches cleared!</p>";
    
    // Test calculation
    echo "<hr>";
    echo "<h2>Test Calculation (₦15,000 package)</h2>";
    
    if (class_exists('App\Helpers\ReferralHelper')) {
        $level1 = App\Helpers\ReferralHelper::calculateCommission(15000, 1);
        $level2 = App\Helpers\ReferralHelper::calculateCommission(15000, 2);
        $level3 = App\Helpers\ReferralHelper::calculateCommission(15000, 3);
        
        echo "<table border='1' cellpadding='10'>";
        echo "<tr><th>Level</th><th>Percentage</th><th>Amount</th></tr>";
        echo "<tr><td>Level 1</td><td>8%</td><td>₦" . number_format($level1, 2) . "</td></tr>";
        echo "<tr><td>Level 2</td><td>2%</td><td>₦" . number_format($level2, 2) . "</td></tr>";
        echo "<tr><td>Level 3</td><td>1%</td><td>₦" . number_format($level3, 2) . "</td></tr>";
        echo "<tr><td><strong>Total</strong></td><td><strong>11%</strong></td><td><strong>₦" . number_format($level1 + $level2 + $level3, 2) . "</strong></td></tr>";
        echo "</table>";
        
        echo "<p style='color: green;'>✅ ReferralHelper is working correctly!</p>";
    } else {
        echo "<p style='color: red;'>❌ WARNING: ReferralHelper class not found!</p>";
        echo "<p>Make sure you uploaded: <code>app/Helpers/ReferralHelper.php</code></p>";
    }
    
    echo "<hr>";
    echo "<h2 style='color: green;'>✅ SETUP COMPLETE!</h2>";
    echo "<p><strong>IMPORTANT:</strong> Delete this file (setup-commissions.php) now for security!</p>";
    echo "<p>Test with a NEW package purchase. Old commissions (27%) were from before the update.</p>";
    
} catch (Exception $e) {
    echo "<p style='color: red;'>❌ ERROR: " . $e->getMessage() . "</p>";
    echo "<pre>" . $e->getTraceAsString() . "</pre>";
}
?>
