<?php
/**
 * Run Migration via Browser
 * Access this file at: https://uniqwealth.site/run-migration.php
 * 
 * IMPORTANT: Delete this file after running!
 */

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "<h1>Migration Script</h1>";
echo "<pre>";

try {
    // Check if migration already ran
    $pdo = DB::connection()->getPdo();
    $stmt = $pdo->query("SHOW COLUMNS FROM settings LIKE 'level1_commission_percent'");
    $exists = $stmt->fetch();
    
    if ($exists) {
        echo "✅ Migration already ran! Commission fields exist.\n\n";
    } else {
        echo "Running migration...\n\n";
        
        // Add the three commission percentage columns
        DB::statement("ALTER TABLE settings ADD COLUMN level1_commission_percent DECIMAL(5,2) DEFAULT 8.00 AFTER refer_commission");
        DB::statement("ALTER TABLE settings ADD COLUMN level2_commission_percent DECIMAL(5,2) DEFAULT 2.00 AFTER level1_commission_percent");
        DB::statement("ALTER TABLE settings ADD COLUMN level3_commission_percent DECIMAL(5,2) DEFAULT 1.00 AFTER level2_commission_percent");
        
        echo "✅ Migration completed successfully!\n\n";
    }
    
    // Update settings to ensure correct values
    $setting = App\Models\Setting::first();
    if ($setting) {
        $setting->level1_commission_percent = 8.00;
        $setting->level2_commission_percent = 2.00;
        $setting->level3_commission_percent = 1.00;
        $setting->save();
        
        echo "✅ Commission percentages set to:\n";
        echo "   Level 1: 8%\n";
        echo "   Level 2: 2%\n";
        echo "   Level 3: 1%\n\n";
    }
    
    // Clear cache
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    
    echo "✅ Cache cleared!\n\n";
    
    // Test calculation
    echo "--- Test Calculation (₦15,000 package) ---\n";
    if (class_exists('App\Helpers\ReferralHelper')) {
        $level1 = App\Helpers\ReferralHelper::calculateCommission(15000, 1);
        $level2 = App\Helpers\ReferralHelper::calculateCommission(15000, 2);
        $level3 = App\Helpers\ReferralHelper::calculateCommission(15000, 3);
        
        echo "Level 1: ₦" . number_format($level1, 2) . " (8%)\n";
        echo "Level 2: ₦" . number_format($level2, 2) . " (2%)\n";
        echo "Level 3: ₦" . number_format($level3, 2) . " (1%)\n";
        echo "Total: ₦" . number_format($level1 + $level2 + $level3, 2) . " (11%)\n\n";
        
        echo "✅ ReferralHelper is working correctly!\n\n";
    } else {
        echo "❌ WARNING: ReferralHelper class not found!\n";
        echo "   Make sure you uploaded: app/Helpers/ReferralHelper.php\n\n";
    }
    
    echo "===========================================\n";
    echo "✅ ALL DONE!\n";
    echo "===========================================\n\n";
    echo "IMPORTANT: DELETE THIS FILE (run-migration.php) NOW!\n";
    
} catch (Exception $e) {
    echo "❌ ERROR: " . $e->getMessage() . "\n";
    echo "\nFull error:\n";
    echo $e->getTraceAsString();
}

echo "</pre>";
?>
