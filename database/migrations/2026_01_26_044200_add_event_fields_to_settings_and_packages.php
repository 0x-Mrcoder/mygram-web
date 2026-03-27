<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->boolean('event_active')->default(0)->after('payment_mode');
            $table->string('event_title')->nullable()->after('event_active');
            $table->dateTime('event_end_time')->nullable()->after('event_title');
            $table->double('event_discount_percent', 8, 2)->default(0)->after('event_end_time');
        });

        Schema::table('packages', function (Blueprint $table) {
            $table->boolean('is_event_active')->default(0)->after('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn(['event_active', 'event_title', 'event_end_time', 'event_discount_percent']);
        });

        Schema::table('packages', function (Blueprint $table) {
            $table->dropColumn('is_event_active');
        });
    }
};
