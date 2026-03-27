<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            // Add commission percentage fields for 3 levels
            $table->decimal('level1_commission_percent', 5, 2)->default(8.00)->after('refer_commission');
            $table->decimal('level2_commission_percent', 5, 2)->default(2.00)->after('level1_commission_percent');
            $table->decimal('level3_commission_percent', 5, 2)->default(1.00)->after('level2_commission_percent');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn(['level1_commission_percent', 'level2_commission_percent', 'level3_commission_percent']);
        });
    }
};
