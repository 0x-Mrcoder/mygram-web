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
            $table->string('virtual_gateway')->default('payrant')->after('payment_mode');
            $table->string('vtstack_api_key')->nullable()->after('virtual_gateway');
            $table->string('vtstack_webhook_secret')->nullable()->after('vtstack_api_key');
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
            $table->dropColumn(['virtual_gateway', 'vtstack_api_key', 'vtstack_webhook_secret']);
        });
    }
};
