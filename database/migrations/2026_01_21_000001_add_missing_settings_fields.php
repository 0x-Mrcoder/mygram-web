<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            // Check if columns exist before adding
            if (!Schema::hasColumn('settings', 'registration_bonus')) {
                $table->decimal('registration_bonus', 15, 2)->default(0);
            }
            if (!Schema::hasColumn('settings', 'refer_commission')) {
                $table->decimal('refer_commission', 15, 2)->default(0);
            }
            if (!Schema::hasColumn('settings', 'refer_limit')) {
                $table->integer('refer_limit')->default(100);
            }
        });

        // Insert a default row if the table is empty, because the setting() helper expects a row to exist.
        if (DB::table('settings')->count() == 0) {
            DB::table('settings')->insert([
                'logo' => 'default_logo.png',
                'favicon' => 'default_favicon.png',
                'site_name' => 'FortuneFlow',
                'site_title' => 'FortuneFlow',
                'registration_bonus' => 0,
                'refer_commission' => 0,
                'refer_limit' => 100,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn(['registration_bonus', 'refer_commission', 'refer_limit']);
        });
    }
};
